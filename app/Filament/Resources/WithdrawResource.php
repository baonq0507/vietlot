<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithdrawResource\Pages;
use App\Filament\Resources\WithdrawResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Transaction;
use Filament\Notifications\Notification;

class WithdrawResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Rút tiền';

    protected static ?string $pluralNavigationLabel = 'Rút tiền';

    protected static ?string $label = 'Rút tiền';

    protected static ?string $pluralLabel = 'Rút tiền';
    protected static ?string $navigationGroup = 'Quản lý giao dịch';

    //query
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'withdraw')->orderBy('created_at', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin rút tiền')
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
                        Forms\Components\Select::make('bank_id')
                            ->relationship('bank', 'bank_name')
                            ->label('Ngân hàng')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label('Người chơi'),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Số tiền')
                    ->numeric(),
                Tables\Columns\TextColumn::make('bank.bank_name')
                    ->label('Ngân hàng'),
                Tables\Columns\TextColumn::make('bank.bank_number')
                    ->label('Số tài khoản'),
                Tables\Columns\TextColumn::make('bank.bank_owner')
                    ->label('Chủ tài khoản'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày rút')
                    ->dateTime('d-m-Y H:i:s'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
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
                            Notification::make()
                                ->success()
                                ->title('Rút tiền thành công')
                                ->body('Số tiền rút: ' . number_format($record->amount, 2, ',', '.'))
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
                                ->title('Rút tiền thất bại')
                                ->body('Số tiền rút: ' . number_format($record->amount, 2, ',', '.'))
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
            'index' => Pages\ListWithdraws::route('/'),
            'create' => Pages\CreateWithdraw::route('/create'),
            'edit' => Pages\EditWithdraw::route('/{record}/edit'),
        ];
    }
}
