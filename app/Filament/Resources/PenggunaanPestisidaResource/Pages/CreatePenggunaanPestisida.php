<?php

namespace App\Filament\Resources\PenggunaanPestisidaResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PenggunaanPestisidaResource;

class CreatePenggunaanPestisida extends CreateRecord
{
    protected static string $resource = PenggunaanPestisidaResource::class;

    protected static ?string $title = 'Tambah Data Penggunaan Pestisida';
    protected static ?string $breadcrumb = "Tambah Data Penggunaan Pestisida";

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

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
        ->success()->title('Berhasil Ditambahkan')
        ->body('Data baru berhasil ditambahkan')
        ->color('success')
        ->seconds(3);
    }
}
