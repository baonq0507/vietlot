<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Transaction;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Section;
use App\Filament\Resources\UserGameResource\RelationManagers\UsersRelationManager;
use App\Filament\Resources\UserBankResource\RelationManagers\UserBankRelationManager;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Người chơi';

    protected static ?string $pluralNavigationLabel = 'Người chơi';

    protected static ?string $label = 'Người chơi';

    protected static ?string $pluralLabel = 'Người chơi';

    protected static ?string $navigationGroup = 'Quản lý tài khoản';

    //query
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('id', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin tài khoản')
                    ->schema([
                        Forms\Components\TextInput::make('username')
                            ->label('Tên tài khoản')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('balance')
                            ->label('Số dư')
                            ->required()
                            ->default(0)
                            ->numeric(),
                        Forms\Components\TextInput::make('total_withdraw')
                            ->formatStateUsing(fn(User $record) => $record->total_withdraw ?? 0)
                            ->label('Tổng rút')
                            ->readOnly()
                            ->numeric(),
                        Forms\Components\TextInput::make('total_deposit')
                            ->formatStateUsing(fn(User $record) => $record->total_deposit ?? 0)
                            ->label('Tổng nạp')
                            ->readOnly()
                            ->numeric(),
                        Forms\Components\TextInput::make('total_reward')
                            ->formatStateUsing(fn(User $record) => $record->total_reward ?? 0)
                            ->label('Tổng thưởng')
                            ->readOnly()
                            ->numeric(),
                    ])->columns(2),
                Section::make('Thông tin đặt cược')
                    ->schema([
                        Forms\Components\TextInput::make('total_bet')
                            ->label('Tổng đặt cược')
                            ->formatStateUsing(fn(User $record) => $record->total_bet ?? 0)
                            ->readOnly()
                            ->numeric(),

                        Forms\Components\TextInput::make('total_win')
                            ->label('Tổng thắng')
                            ->formatStateUsing(fn(User $record) => $record->total_win ?? 0)
                            ->readOnly()
                            ->numeric(),
                    ])->columns(2),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->label('Tên tài khoản')
                    ->sortable(),
                Tables\Columns\TextColumn::make('balance')
                    ->label('Số dư')
                    ->formatStateUsing(fn($state) => number_format($state, 2, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_withdraw')
                    ->label('Tổng rút')
                    ->formatStateUsing(fn($state) => number_format($state, 2, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_deposit')
                    ->label('Tổng nạp')
                    ->formatStateUsing(fn($state) => number_format($state, 2, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_reward')
                    ->label('Tổng thưởng')
                    ->formatStateUsing(fn($state) => number_format($state, 2, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Xem chi tiết')
                        ->icon('heroicon-o-pencil-square')->color('warning'),
                    Tables\Actions\Action::make('reward')
                        ->label('Thưởng tiền')
                        ->form([
                            Forms\Components\TextInput::make('reward_money')
                                ->label('Thưởng tiền')
                                ->default(0)
                                ->numeric(),
                        ])->icon('heroicon-o-currency-dollar')->color('success')
                        ->action(function ($data, $record) {
                            $record->balance += $data['reward_money'];
                            $record->save();
                            Transaction::create([
                                'user_id' => $record->id,
                                'amount' => $data['reward_money'],
                                'balance' => $record->balance,
                                'type' => 'reward',
                                'status' => 'success',
                                'description' => 'Thưởng tiền từ hệ thống',
                            ]);
                            Notification::make()->title('Thưởng tiền thành công')->success()->send();
                        }),
                    //nạp tiền
                    Tables\Actions\Action::make('deposit')
                        ->label('Nạp tiền')
                        ->form([
                            Forms\Components\TextInput::make('deposit_money')
                                ->label('Nạp tiền')
                        ])
                        ->action(function ($data, $record) {
                            $record->balance += $data['deposit_money'];
                            $record->save();
                            Transaction::create([
                                'user_id' => $record->id,
                                'amount' => $data['deposit_money'],
                                'balance' => $record->balance,
                                'type' => 'deposit',
                                'status' => 'success',
                                'description' => 'Nạp tiền từ hệ thống',
                            ]);
                            Notification::make()->title('Nạp tiền thành công')->success()->send();
                        })->icon('heroicon-o-currency-dollar')->color('success'),
                    //khóa tài khoản
                    Tables\Actions\Action::make('lock')
                        ->label('Khóa tài khoản')
                        ->action(function ($record) {
                            $record->is_locked = true;
                            $record->save();
                            Notification::make()->title('Khóa tài khoản thành công')->success()->send();
                        })->visible(fn($record) => !$record->is_locked)->icon('heroicon-o-lock-closed')->color('danger'),
                    //mở khóa tài khoản
                    Tables\Actions\Action::make('unlock')
                        ->label('Mở khóa tài khoản')
                        ->action(function ($record) {
                            $record->is_locked = false;
                            $record->save();
                            Notification::make()->title('Mở khóa tài khoản thành công')->success()->send();
                        })->visible(fn($record) => $record->is_locked)->icon('heroicon-o-lock-open')->color('success'),
                    //đổi mật khẩu
                    Tables\Actions\Action::make('change_password')
                        ->label('Đổi mật khẩu')
                        ->form([
                            Forms\Components\TextInput::make('password')
                                ->label('Mật khẩu')
                        ])
                        ->action(function ($data, $record) {
                            $record->password = Hash::make($data['password']);
                            $record->save();
                            Notification::make()->title('Đổi mật khẩu thành công')->success()->send();
                        })->icon('heroicon-o-key')->color('success'),
                ])->icon('heroicon-o-ellipsis-horizontal')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
            UserBankRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
