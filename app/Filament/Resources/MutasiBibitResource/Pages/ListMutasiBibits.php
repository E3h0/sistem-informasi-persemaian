<?php

namespace App\Filament\Resources\MutasiBibitResource\Pages;

use App\Filament\Resources\MutasiBibitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMutasiBibits extends ListRecords
{
    protected static string $resource = MutasiBibitResource::class;

    protected static ?string $breadcrumb = 'Daftar Mutasi Bibit';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
