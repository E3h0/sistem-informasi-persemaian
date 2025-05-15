<?php

namespace App\Filament\Resources\TargetProduksiResource\Pages;

use App\Filament\Resources\TargetProduksiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTargetProduksi extends CreateRecord
{
    protected static string $resource = TargetProduksiResource::class;

    protected static ?string $title = 'Tambah Data Target Produksi';

    protected static ?string $breadcrumb = 'Tambah Data Target Produksi';

     protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label("Simpan"),
            $this->getCancelFormAction()->label("Batalkan")
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
