<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;
use App\Models\Notification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell';

    protected static ?string $navigationLabel = 'Cài đặt thông báo';

    protected static ?string $pluralNavigationLabel = 'Cài đặt thông báo';

    protected static ?string $label = 'Thông báo';

    protected static ?string $pluralLabel = 'Thông báo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin thông báo')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Tiêu đề')
                            ->required(),
                        Forms\Components\TextInput::make('image_url')
                            ->label('Hình ảnh')
                            ->required(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Nội dung')
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'show' => 'Hiển thị',
                                'hide' => 'Ẩn',
                            ])
                            ->default('show'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề'),
                Tables\Columns\TextColumn::make('content')
                    ->label('Nội dung')
                    ->html()
                    ->wrap(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'show' => 'success',
                        'hide' => 'danger',
                    })->formatStateUsing(fn(string $state): string => match ($state) {
                        'show' => 'Hiển thị',
                        'hide' => 'Ẩn',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil')
                        ->color('warning')
                        ->label('Sửa'),
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->label('Xóa'),
                    //action show
                    Tables\Actions\Action::make('show')
                        ->label('Hiển thị')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(function (Notification $record) {
                            $record->status = 'show';
                            $record->save();
                        })->visible(function (Notification $record) {
                            return $record->status == 'hide';
                        }),
                    //action hide
                    Tables\Actions\Action::make('hide')
                        ->label('Ẩn')
                        ->icon('heroicon-o-eye-slash')
                        ->color('danger')
                        ->action(function (Notification $record) {
                            $record->status = 'hide';
                            $record->save();
                        })->visible(function (Notification $record) {
                            return $record->status == 'show';
                        }),
                ])->icon('heroicon-o-ellipsis-horizontal'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }
}
