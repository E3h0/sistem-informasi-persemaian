<?php

namespace App\Filament\Resources\PenggunaanPupukResource\Pages;

use App\Filament\Resources\PenggunaanPupukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenggunaanPupuk extends EditRecord
{
    protected static string $resource = PenggunaanPupukResource::class;

    protected static ?string $title = 'Edit Data Penggunaan Pupuk';
    protected static ?string $breadcrumb = "Edit Data Penggunaan Pupuk";

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label("Simpan Perubahan"),
            $this->getCancelFormAction()->label("Batalkan")
        ];
    }
}
