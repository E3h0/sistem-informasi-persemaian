<?php

namespace App\Filament\Resources\PenggunaanPupukResource\Pages;

use App\Filament\Resources\PenggunaanPupukResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenggunaanPupuk extends CreateRecord
{
    protected static string $resource = PenggunaanPupukResource::class;

    protected static ?string $title = 'Tambah Data Penggunaan Pupuk';
    protected static ?string $breadcrumb = "Tambah Data Penggunaan Pupuk";

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label("Simpan"),
            $this->getCancelFormAction()->label("Batalkan")
        ];
    }
}
