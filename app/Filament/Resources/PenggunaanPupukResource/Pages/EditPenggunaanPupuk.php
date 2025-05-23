<?php

namespace App\Filament\Resources\PenggunaanPupukResource\Pages;

use App\Filament\Resources\PenggunaanPupukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenggunaanPupuk extends EditRecord
{
    protected static string $resource = PenggunaanPupukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
