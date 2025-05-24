<?php

namespace App\Filament\Resources\PenggunaanPestisidaResource\Pages;

use App\Filament\Resources\PenggunaanPestisidaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenggunaanPestisida extends EditRecord
{
    protected static string $resource = PenggunaanPestisidaResource::class;

    protected static ?string $title = 'Edit Data Penggunaan Pestisida';
    protected static ?string $breadcrumb = "Edit Data Penggunaan Pestisida";

    
}
