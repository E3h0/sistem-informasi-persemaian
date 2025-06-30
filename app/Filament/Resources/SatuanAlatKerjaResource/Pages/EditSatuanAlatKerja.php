<?php

namespace App\Filament\Resources\SatuanAlatKerjaResource\Pages;

use App\Filament\Resources\SatuanAlatKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSatuanAlatKerja extends EditRecord
{
    protected static string $resource = SatuanAlatKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
