<?php

namespace App\Filament\Resources\KategoriPestisidaResource\Pages;

use App\Filament\Resources\KategoriPestisidaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriPestisida extends EditRecord
{
    protected static string $resource = KategoriPestisidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
