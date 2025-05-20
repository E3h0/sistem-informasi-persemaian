<?php

namespace App\Filament\Resources\PersediaanAlatKerjaResource\Pages;

use App\Filament\Resources\PersediaanAlatKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersediaanAlatKerjas extends ListRecords
{
    protected static string $resource = PersediaanAlatKerjaResource::class;
    protected static ?string $title = 'Persediaan Alat Kerja';
    protected static ?string $breadcrumb = "Daftar Alat Kerja";
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
