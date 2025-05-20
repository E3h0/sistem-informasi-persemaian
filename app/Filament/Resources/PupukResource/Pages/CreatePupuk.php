<?php

namespace App\Filament\Resources\PupukResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\PupukResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePupuk extends CreateRecord
{
    protected static string $resource = PupukResource::class;

    protected static ?string $title = 'Tambah Data Pupuk';
    protected static ?string $breadcrumb = "Tambah Data Pupuk";

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label("Simpan"),
            $this->getCancelFormAction()->label("Batalkan")
        ];
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
