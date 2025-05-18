<?php

namespace App\Filament\Resources\MutasiBibitResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\MutasiBibitResource;

class EditMutasiBibit extends EditRecord
{
    protected static string $resource = MutasiBibitResource::class;

    protected static ?string $title = 'Edit Data Mutasi Bibit';

    protected static ?string $breadcrumb = 'Edit Data Target Produksi';

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label('Simpan Perubahan'),
            $this->getCancelFormAction()->label('Batalkan')
        ];
    }

    protected function getRedirectUrl(): ?string
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
