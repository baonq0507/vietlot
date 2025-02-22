<?php

namespace App\Filament\Resources\UserBankResource\Pages;

use App\Filament\Resources\UserBankResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserBank extends EditRecord
{
    protected static string $resource = UserBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
