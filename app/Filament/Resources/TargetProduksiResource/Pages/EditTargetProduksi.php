<?php

namespace App\Filament\Resources\TargetProduksiResource\Pages;

use App\Filament\Resources\TargetProduksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTargetProduksi extends EditRecord
{
    protected static string $resource = TargetProduksiResource::class;

    protected static ?string $title = 'Edit Data Target Produksi';

    protected static ?string $breadcrumb = 'Edit Data Target Produksi';
}
