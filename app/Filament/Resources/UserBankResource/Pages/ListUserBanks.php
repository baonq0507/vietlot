<?php

namespace App\Filament\Resources\UserBankResource\Pages;

use App\Filament\Resources\UserBankResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserBanks extends ListRecords
{
    protected static string $resource = UserBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
