<?php

namespace App\Filament\Resources\PestisidaResource\Pages;

use App\Filament\Resources\PestisidaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePestisida extends CreateRecord
{
    protected static string $resource = PestisidaResource::class;
    protected static ?string $title = 'Tambah Data Pestisida';
    protected static ?string $breadcrumb = "Tambah Data Pestisida";
}
