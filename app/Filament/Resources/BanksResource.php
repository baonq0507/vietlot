<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BanksResource\Pages;
use App\Filament\Resources\BanksResource\RelationManagers;
use App\Models\Banks;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
class BanksResource extends Resource
{
    protected static ?string $model = Banks::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Quản lý ngân hàng';

    protected static ?string $pluralNavigationLabel = 'Quản lý ngân hàng';

    protected static ?string $label = 'ngân hàng';

    protected static ?string $pluralLabel = 'Quản lý ngân hàng';

    protected static ?string $navigationGroup = 'Quản lý tài khoản';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bank_name')
                    ->label('Tên ngân hàng')
                    ->required(),
                Forms\Components\TextInput::make('bank_number')
                    ->label('Số tài khoản')
                    ->required(),
                Forms\Components\TextInput::make('bank_owner')
                    ->label('Chủ tài khoản')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'show' => 'Hiển thị',
                        'hide' => 'Ẩn',
                    ])
                    ->default('show')
                    ->required(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bank_name')
                    ->label('Tên ngân hàng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_number')
                    ->label('Số tài khoản')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_owner')
                    ->label('Chủ tài khoản')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn($state) => $state === 'show' ? 'success' : 'danger')
                    ->formatStateUsing(fn($state) => $state === 'show' ? 'Hiển thị' : 'Ẩn'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\CreateAction::make()
                //     ->label('Thêm mới')
                //     ->modalHeading('Thêm mới ngân hàng')
                //     ->form([
                //         Forms\Components\TextInput::make('bank_name')
                //             ->label('Tên ngân hàng')
                //             ->required(),
                //         Forms\Components\TextInput::make('bank_number')
                //             ->label('Số tài khoản')
                //             ->required(),
                //         Forms\Components\TextInput::make('bank_owner')
                //             ->label('Chủ tài khoản')
                //             ->required(),
                //         Forms\Components\Select::make('status')
                //             ->label('Trạng thái')
                //             ->options([
                //                 'show' => 'Hiển thị',
                //                 'hide' => 'Ẩn',
                //             ])
                //             ->required(),
                //     ])
                //     ->action(function ($data) {
                //         Banks::create($data);
                //         Notification::make()->title('Thêm mới ngân hàng thành công')->success()->send();
                //     })
                Tables\Actions\EditAction::make()
                    ->label('Sửa')
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('bank_name')
                                    ->label('Tên ngân hàng')
                                    ->required(),
                                Forms\Components\TextInput::make('bank_number')
                                    ->label('Số tài khoản')
                                    ->required(),
                                Forms\Components\TextInput::make('bank_owner')
                                    ->label('Chủ tài khoản')
                                    ->required(),
                                Forms\Components\Select::make('status')
                                    ->label('Trạng thái')
                                    ->options([
                                        'show' => 'Hiển thị',
                                        'hide' => 'Ẩn',
                                    ])
                                    ->required(),
                            ])
                    ])
                    ->action(function ($data, $record) {
                        $record->update($data);
                        Notification::make()->title('Cập nhật ngân hàng thành công')->success()->send();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa')
                    ->action(function ($record) {
                        $record->delete();
                        Notification::make()->title('Xóa ngân hàng thành công')->success()->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa')
                        ->action(function ($record) {
                            $record->delete();
                            Notification::make()->title('Xóa ngân hàng thành công')->success()->send();
                        }),
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
            'index' => Pages\ListBanks::route('/'),
            // 'create' => Pages\CreateBanks::route('/create'),
            // 'edit' => Pages\EditBanks::route('/{record}/edit'),
        ];
    }
}
