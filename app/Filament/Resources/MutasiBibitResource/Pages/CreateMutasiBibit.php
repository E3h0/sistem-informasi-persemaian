<?php

namespace App\Filament\Resources\MutasiBibitResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\MutasiBibitResource;

class CreateMutasiBibit extends CreateRecord
{
    protected static string $resource = MutasiBibitResource::class;

    protected static ?string $title = 'Tambah Data Mutasi Bibit';

    protected static ?string $breadcrumb = 'Tambah Data Mutasi Bibit';

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Simpan'),
            $this->getCancelFormAction()->label('Batalkan')
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
