<?php

namespace App\Filament\Resources\PenggunaanPestisidaResource\Pages;

use App\Filament\Resources\PenggunaanPestisidaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenggunaanPestisida extends CreateRecord
{
    protected static string $resource = PenggunaanPestisidaResource::class;

    protected static ?string $title = 'Tambah Data Penggunaan Pestisida';
    protected static ?string $breadcrumb = "Tambah Data Penggunaan Pestisida";
}
