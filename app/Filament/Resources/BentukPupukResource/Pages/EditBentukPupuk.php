<?php

namespace App\Filament\Resources\BentukPupukResource\Pages;

use App\Filament\Resources\BentukPupukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBentukPupuk extends EditRecord
{
    protected static string $resource = BentukPupukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
