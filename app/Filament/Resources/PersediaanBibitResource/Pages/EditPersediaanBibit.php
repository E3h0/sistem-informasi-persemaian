<?php

namespace App\Filament\Resources\PersediaanBibitResource\Pages;

use App\Filament\Resources\PersediaanBibitResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPersediaanBibit extends EditRecord
{
    protected static string $resource = PersediaanBibitResource::class;
    protected static ?string $title = 'Edit Data Bibit';
    protected static ?string $breadcrumb = "Edit Persediaan Bibit";
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label("Simpan Perubahan"),
            $this->getCancelFormAction()->label("Batalkan")
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
        ->success()->title('Berhasil Diedit')->body('Data berhasil diedit')
        ->color('success')
        ->seconds(3);
    }
}
