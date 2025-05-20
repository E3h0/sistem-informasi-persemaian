<?php

namespace App\Filament\Resources\PersediaanAlatKerjaResource\Pages;

use App\Filament\Resources\PersediaanAlatKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersediaanAlatKerjas extends ListRecords
{
    protected static string $resource = PersediaanAlatKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
