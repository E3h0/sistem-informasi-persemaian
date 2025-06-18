<?php

namespace App\Filament\Resources\BentukPestisidaResource\Pages;

use App\Filament\Resources\BentukPestisidaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBentukPestisida extends EditRecord
{
    protected static string $resource = BentukPestisidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
