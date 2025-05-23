<?php

namespace App\Filament\Resources\PenggunaanPupukResource\Pages;

use App\Filament\Resources\PenggunaanPupukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenggunaanPupuks extends ListRecords
{
    protected static string $resource = PenggunaanPupukResource::class;

    protected static ?string $title = 'Penggunaan Pupuk';
    
    protected static ?string $breadcrumb = "Daftar Penggunaan Pupuk";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
