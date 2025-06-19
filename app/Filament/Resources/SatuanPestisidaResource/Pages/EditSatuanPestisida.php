<?php

namespace App\Filament\Resources\SatuanPestisidaResource\Pages;

use App\Filament\Resources\SatuanPestisidaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSatuanPestisida extends EditRecord
{
    protected static string $resource = SatuanPestisidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
