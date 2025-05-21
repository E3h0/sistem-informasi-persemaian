<?php

namespace App\Filament\Resources\PestisidaResource\Pages;

use App\Filament\Resources\PestisidaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPestisida extends EditRecord
{
    protected static string $resource = PestisidaResource::class;
    protected static ?string $title = 'Edit Data Pestisida';
    protected static ?string $breadcrumb = "Edit Data Pestisida";
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
