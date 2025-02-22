<?php

namespace App\Filament\Resources\UserGameResource\Pages;

use App\Filament\Resources\UserGameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserGame extends EditRecord
{
    protected static string $resource = UserGameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
