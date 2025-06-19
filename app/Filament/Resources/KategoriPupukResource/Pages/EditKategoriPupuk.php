<?php

namespace App\Filament\Resources\KategoriPupukResource\Pages;

use App\Filament\Resources\KategoriPupukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriPupuk extends EditRecord
{
    protected static string $resource = KategoriPupukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
