<?php

namespace App\Filament\Resources\PestisidaResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PestisidaResource;

class EditPestisida extends EditRecord
{
    protected static string $resource = PestisidaResource::class;
    protected static ?string $title = 'Edit Data Pestisida';
    protected static ?string $breadcrumb = "Edit Data Pestisida";

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
