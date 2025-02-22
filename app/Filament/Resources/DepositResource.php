<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepositResource\Pages;
use App\Filament\Resources\DepositResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Transaction;
use Filament\Notifications\Notification;

class DepositResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Nạp tiền';

    protected static ?string $pluralNavigationLabel = 'Nạp tiền';

    protected static ?string $label = 'Nạp tiền';

    protected static ?string $pluralLabel = 'Nạp tiền';

    //group
    protected static ?string $navigationGroup = 'Quản lý giao dịch';

    //query
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'deposit')->orderBy('created_at', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin nạp tiền')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'username')
                            ->searchable()
                            ->preload()
                            ->label('Người chơi')
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Số tiền')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('bank_id')
                            ->label('Ngân hàng')
                            ->required(),
                        Forms\Components\TextInput::make('bank_account')
                            ->label('Số tài khoản')
                            ->required(),
                        Forms\Components\TextInput::make('bank_name')
                            ->label('Tên ngân hàng')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label('Người chơi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Số tiền')
                    ->numeric(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày nạp')
                    ->dateTime('d-m-Y H:i:s'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                    })->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Chờ xác nhận',
                        'success' => 'Đã xác nhận',
                        'failed' => 'Thất bại',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('confirm')
                        ->label('Xác nhận')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Transaction $record) {
                            $record->status = 'success';
                            $record->save();
                            $record->user->balance += $record->amount;
                            $record->user->save();
                            Notification::make()
                                ->success()
                                ->title('Nạp tiền thành công')
                                ->body('Số tiền nạp: ' . number_format($record->amount, 2, ',', '.'))
                                ->send();
                        })->visible(function (Transaction $record) {
                            return $record->status == 'pending';
                        }),
                    Tables\Actions\Action::make('failed')
                        ->label('Thất bại')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function (Transaction $record) {
                            $record->status = 'failed';
                            $record->save();
                            Notification::make()
                                ->danger()
                                ->title('Nạp tiền thất bại')
                                ->body('Số tiền nạp: ' . number_format($record->amount, 2, ',', '.'))
                                ->send();
                        })->visible(function (Transaction $record) {
                            return $record->status == 'pending';
                        }),
                ])->icon('heroicon-o-ellipsis-horizontal'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeposits::route('/'),
            // 'create' => Pages\CreateDeposit::route('/create'),
            // 'edit' => Pages\EditDeposit::route('/{record}/edit'),
        ];
    }
}
