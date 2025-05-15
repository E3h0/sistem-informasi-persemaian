<?php

namespace App\Filament\Resources\PersediaanBibitResource\Pages;

use App\Filament\Resources\PersediaanBibitResource;
use Filament\Actions;
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
}
