<?php

namespace App\Filament\Resources\PersediaanBibitResource\Pages;

use App\Filament\Resources\PersediaanBibitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersediaanBibits extends ListRecords
{
    protected static string $resource = PersediaanBibitResource::class;
    protected static ?string $breadcrumb = "Daftar Persediaan Bibit";
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
