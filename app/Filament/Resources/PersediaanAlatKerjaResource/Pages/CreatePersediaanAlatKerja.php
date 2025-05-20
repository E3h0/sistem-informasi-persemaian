<?php

namespace App\Filament\Resources\PersediaanAlatKerjaResource\Pages;

use App\Filament\Resources\PersediaanAlatKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePersediaanAlatKerja extends CreateRecord
{
    protected static string $resource = PersediaanAlatKerjaResource::class;

    protected static ?string $title = 'Tambah Data Alat Kerja';
    protected static ?string $breadcrumb = "Tambah Data Alat Kerja";

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label("Simpan"),
            $this->getCancelFormAction()->label("Batalkan")
        ];
    }
}
