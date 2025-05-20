<?php

namespace App\Filament\Resources\PersediaanAlatKerjaResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PersediaanAlatKerjaResource;

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
