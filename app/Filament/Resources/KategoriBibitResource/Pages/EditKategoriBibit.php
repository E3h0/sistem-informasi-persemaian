<?php

namespace App\Filament\Resources\KategoriBibitResource\Pages;

use App\Filament\Resources\KategoriBibitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriBibit extends EditRecord
{
    protected static string $resource = KategoriBibitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
