<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserGameResource\Pages;
use App\Filament\Resources\UserGameResource\RelationManagers;
use App\Models\UserGame;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class UserGameResource extends Resource
{
    protected static ?string $model = UserGame::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Lịch sử chơi';

    protected static ?string $pluralModelLabel = 'Lịch sử chơi';

    protected static ?string $label = 'Lịch sử chơi';

    protected static ?string $pluralLabel = 'Lịch sử chơi';

    protected static ?string $navigationGroup = 'Quản lý tài khoản';

    //query
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('created_at', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user.username')
                    ->label('Người chơi')
                    ->disabled(),
                Forms\Components\TextInput::make('game.type')
                    ->label('Trò chơi')
                    ->disabled(),
                Forms\Components\TextInput::make('choose')
                    ->label('Người chơi đặt')
                    ->disabled(),
                Forms\Components\TextInput::make('money')
                    ->label('Tiền đặt cược')
                    ->disabled(),
                Forms\Components\TextInput::make('total_money')
                    ->label('Tổng tiền đặt cược')
                    ->disabled(),
                Forms\Components\Select::make('result')
                    ->label('Kết quả')
                    ->options([
                        'win' => 'Thắng',
                        'lose' => 'Thua'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('total_win')
                    ->label('Tiền thắng')
                    ->numeric()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('game.code')
                    ->label('Số kỳ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.username')
                    ->label('Người chơi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.id')
                    ->label('ID user')
                    ->searchable(),
                Tables\Columns\TextColumn::make('game.type')
                    ->label('Game')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'kenno1p' => 'Kenno 1P',
                            'kenno3p' => 'Kenno 3P',
                            'kenno5p' => 'Kenno 5P',
                            'xoso3p' => 'Xổ số 3P',
                            'xoso5p' => 'Xổ số 5P',
                            'xucxac3p' => 'Xúc xắc 3P',
                            'xucxac5p' => 'Xúc xắc 5P',
                        };
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('choose')
                    ->label('Người chơi đặt')
                    ->formatStateUsing(function ($state, $record) {
                        if ($record && $record->game) {
                            if (str_contains($record->game->type, 'kenno')) {
                                $results = [];
                                $choices = explode(',', $state);

                                foreach ($choices as $choice) {
                                    if (str_contains($choice, 'total')) {
                                        $type = substr($choice, -1);
                                        $displayType = match ($type) {
                                            't' => 'Tài',
                                            'x' => 'Xỉu',
                                            'c' => 'Chẵn',
                                            'l' => 'Lẻ',
                                            default => ''
                                        };
                                        $results[] = "Tổng " . $displayType;
                                    } elseif (str_contains($choice, 'bi')) {
                                        $bi = substr($choice, 3, 1); // Get single digit
                                        $type = substr($choice, -1);
                                        $displayType = match ($type) {
                                            'l' => 'Lẻ',
                                            'c' => 'Chẵn',
                                            't' => 'Tài',
                                            'x' => 'Xỉu',
                                            default => ''
                                        };
                                        $results[] = "Bi " . $bi . " " . $displayType;
                                    }
                                }

                                return implode(', ', $results);
                            } elseif (str_contains($record->game->type, 'xucxac')) {
                                $results = [];
                                $choices = explode(',', $state);

                                foreach ($choices as $choice) {
                                    if (str_contains($choice, 'cltx')) {
                                        $type = substr($choice, -1);
                                        $displayType = match ($type) {
                                            't' => 'Tài',
                                            'x' => 'Xỉu',
                                            'c' => 'Chẵn',
                                            'l' => 'Lẻ',
                                            default => ''
                                        };
                                        $results[] = "Cltx " . $displayType;
                                    } elseif (str_contains($choice, '2st')) {
                                        if (substr($choice, -5) === 'every') {
                                            $results[] = "2 số trùng bất kì";
                                        } else {
                                            $results[] = "2 số trùng " . substr($choice, -2);
                                        }
                                    } elseif (str_contains($choice, '3st')) {
                                        if (substr($choice, -5) === 'every') {
                                            $results[] = "3 số trùng bất kì";
                                        } else {
                                            $results[] = "3 số trùng " . substr($choice, -3);
                                        }
                                    }
                                }
                                return implode(', ', $results);
                            } elseif (str_contains($record->game->type, 'xoso')) {
                                $results = [];
                                $choices = explode(',', $state);
                                foreach ($choices as $choice) {
                                    if (str_contains($choice, 'de')) {
                                        $results[] = "Đề " . substr($choice, -3);
                                    } elseif (str_contains($choice, 'lothuong')) {
                                        $results[] = "Lô thường " . substr($choice, -3);
                                    } elseif (str_contains($choice, 'loxien2')) {
                                        $results[] = "Lô xiên 2 " . substr($choice, -3);
                                    } elseif (str_contains($choice, 'loxien3')) {
                                        $results[] = "Lô xiên 3 " . substr($choice, -3);
                                    } elseif (str_contains($choice, 'loxien4')) {
                                        $results[] = "Lô xiên 4 " . substr($choice, -3);
                                    } elseif (str_contains($choice, 'db')) {
                                        $results[] = "Đặc biệt " . substr($choice, -3);
                                    } elseif (str_contains($choice, 'bacang')) {
                                        $results[] = "Ba càng " . substr($choice, -3);
                                    }
                                }
                                return implode(', ', $results);
                            }
                        }

                        return '';
                    }),

                Tables\Columns\TextColumn::make('money')
                    ->label('Tiền đặt cược')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_money')
                    ->label('Tổng tiền đặt cược')
                    ->searchable(),
                Tables\Columns\TextColumn::make('result')
                    ->label('Kết quả')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'win' => 'Thắng',
                            'lose' => 'Thua',
                            default => ''
                        };
                    })->badge()
                    ->color(fn($state) => $state === 'win' ? 'success' : 'danger')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_win')
                    ->label('Tiền thắng')
                    ->searchable(),


                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->searchable(),


            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Người chơi')
                    ->relationship('user', 'username')
                    ->preload()
                    ->searchable(),
                Tables\Filters\SelectFilter::make('game_id')
                    ->options([
                        'kenno1p' => 'Kenno 1P',
                        'kenno3p' => 'Kenno 3P',
                        'kenno5p' => 'Kenno 5P',
                        'xoso3p' => 'Xổ số 3P',
                        'xoso5p' => 'Xổ số 5P',
                        'xucxac3p' => 'Xúc xắc 3P',
                        'xucxac5p' => 'Xúc xắc 5P',
                    ])
                    ->label('Game'),
                Tables\Filters\SelectFilter::make('result')
                    ->label('Kết quả')
                    ->options([
                        'win' => 'Thắng',
                        'lose' => 'Thua',
                    ])
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa')
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('money')
                                    ->default(fn($record) => $record->money)
                                    ->label('Tiền đặt cược'),
                                Forms\Components\TextInput::make('total_money')
                                    ->default(fn($record) => $record->total_money)
                                    ->label('Tổng tiền đặt cược'),
                                Forms\Components\Select::make('result')
                                    ->default(fn($record) => $record->result)
                                    ->label('Kết quả')
                                    ->options([
                                        'win' => 'Thắng',
                                        'lose' => 'Thua'
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('total_win')
                                    ->label('Tiền thắng')
                                    ->numeric()
                                    ->required(),
                            ])
                    ])
                    ->action(function ($data, $record) {
                        $record->update([
                            'money' => $data['money'],
                            'total_money' => $data['total_money'],
                            'result' => $data['result'],
                            'total_win' => $data['total_win'],
                        ]);
                        Notification::make()->title('Cập nhật kết quả thành công')->success()->send();
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->poll('4s');
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
            'index' => Pages\ListUserGames::route('/'),
            // 'edit' => Pages\EditUserGame::route('/{record}/edit'),
        ];
    }
}
