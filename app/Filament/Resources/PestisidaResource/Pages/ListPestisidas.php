<?php

namespace App\Filament\Resources\PestisidaResource\Pages;

use App\Filament\Resources\PestisidaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPestisidas extends ListRecords
{
    protected static string $resource = PestisidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
