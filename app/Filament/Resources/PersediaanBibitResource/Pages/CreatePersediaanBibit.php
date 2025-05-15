<?php

namespace App\Filament\Resources\PersediaanBibitResource\Pages;

use App\Filament\Resources\PersediaanBibitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use illuminate\Contracts\Support\Htmlable;

class CreatePersediaanBibit extends CreateRecord
{
    protected static string $resource = PersediaanBibitResource::class;
    protected static ?string $title = 'Tambah Data Persediaan Bibit';
    protected static ?string $breadcrumb = "Tambah Data Persediaan Bibit";

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
