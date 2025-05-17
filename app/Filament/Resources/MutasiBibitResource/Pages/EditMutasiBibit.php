<?php

namespace App\Filament\Resources\MutasiBibitResource\Pages;

use App\Filament\Resources\MutasiBibitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMutasiBibit extends EditRecord
{
    protected static string $resource = MutasiBibitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
