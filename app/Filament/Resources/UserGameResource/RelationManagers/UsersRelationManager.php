<?php

namespace App\Filament\Resources\UserGameResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'userGames';

    protected static ?string $title = 'Lịch sử đặt cược';

    protected static ?string $pluralTitle = 'Lịch sử đặt cược';

    //query
    public function query(): Builder
    {
        return parent::query()->orderBy('created_at', 'desc');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label('Tài khoản'),
                Tables\Columns\TextColumn::make('game.code')
                    ->label('Kỳ'),
                Tables\Columns\TextColumn::make('total_money')
                    ->label('Tổng đặt cược'),
                Tables\Columns\TextColumn::make('total_win')
                    ->label('Tổng thắng'),
                Tables\Columns\TextColumn::make('result')
                    ->label('Kết quả')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'win' => 'success',
                        'lose' => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => $state == 'win' ? 'Thắng' : 'Thua'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày đặt cược'),
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
