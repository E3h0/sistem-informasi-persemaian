<?php

namespace App\Filament\Resources\TargetProduksiResource\Pages;

use App\Filament\Resources\TargetProduksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTargetProduksis extends ListRecords
{
    protected static string $resource = TargetProduksiResource::class;

    protected static ?string $breadcrumb = 'Daftar Target Produksi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
