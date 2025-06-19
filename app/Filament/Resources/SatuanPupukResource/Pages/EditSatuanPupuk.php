<?php

namespace App\Filament\Resources\SatuanPupukResource\Pages;

use App\Filament\Resources\SatuanPupukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSatuanPupuk extends EditRecord
{
    protected static string $resource = SatuanPupukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
