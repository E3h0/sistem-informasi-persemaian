<?php

namespace App\Filament\Resources\KategoriAlatKerjaResource\Pages;

use App\Filament\Resources\KategoriAlatKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriAlatKerja extends EditRecord
{
    protected static string $resource = KategoriAlatKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
