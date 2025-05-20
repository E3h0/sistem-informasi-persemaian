<?php

namespace App\Filament\Resources\PupukResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PupukResource;

class EditPupuk extends EditRecord
{
    protected static string $resource = PupukResource::class;

    protected static ?string $title = 'Edit Data Pupuk';
    protected static ?string $breadcrumb = "Edit Data Pupuk";

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label("Simpan Perubahan"),
            $this->getCancelFormAction()->label("Batalkan")
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
        ->success()->title('Berhasil Diedit')->body('Data berhasil diedit')
        ->color('success')
        ->seconds(3);
    }
}
