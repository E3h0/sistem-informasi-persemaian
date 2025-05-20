<?php

namespace App\Filament\Resources\PersediaanAlatKerjaResource\Pages;

use App\Filament\Resources\PersediaanAlatKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersediaanAlatKerja extends EditRecord
{
    protected static string $resource = PersediaanAlatKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
