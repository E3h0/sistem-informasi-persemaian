<?php

namespace App\Filament\Resources\TargetProduksiResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\TargetProduksiResource;

class EditTargetProduksi extends EditRecord
{
    protected static string $resource = TargetProduksiResource::class;

    protected static ?string $title = 'Edit Data Target Produksi';

    protected static ?string $breadcrumb = 'Edit Data Target Produksi';

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
