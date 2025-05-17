<?php

namespace App\Filament\Resources\MutasiBibitResource\Pages;

use App\Filament\Resources\MutasiBibitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMutasiBibits extends ListRecords
{
    protected static string $resource = MutasiBibitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
