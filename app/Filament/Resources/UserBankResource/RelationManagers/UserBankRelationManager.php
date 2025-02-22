<?php

namespace App\Filament\Resources\UserBankResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserBankRelationManager extends RelationManager
{
    protected static string $relationship = 'userBanks';

    protected static ?string $title = 'Ngân hàng';

    protected static ?string $pluralTitle = 'Ngân hàng';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('id')
                //     ->required()
                //     ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('bank_name')
                    ->label('Tên ngân hàng'),
                Tables\Columns\TextColumn::make('bank_number')
                    ->label('Số tài khoản'),
                Tables\Columns\TextColumn::make('bank_owner')
                    ->label('Tên chủ tài khoản'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
