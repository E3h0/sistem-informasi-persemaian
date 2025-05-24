<?php

namespace App\Filament\Resources\PenggunaanPestisidaResource\Pages;

use App\Filament\Resources\PenggunaanPestisidaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenggunaanPestisidas extends ListRecords
{
    protected static string $resource = PenggunaanPestisidaResource::class;

    protected static ?string $title = 'Penggunaan Pestisida';

    protected static ?string $breadcrumb = "Daftar Penggunaan Pestisida";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->make()->label('Tambah Data Baru'),
        ];
    }
}
