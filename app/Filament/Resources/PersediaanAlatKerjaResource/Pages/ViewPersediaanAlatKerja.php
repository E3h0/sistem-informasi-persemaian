<?php

namespace App\Filament\Resources\PersediaanAlatKerjaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\PersediaanAlatKerjaResource;

class ViewPersediaanAlatKerja extends ViewRecord
{
    protected static string $resource = PersediaanAlatKerjaResource::class;
    protected static ?string $breadcrumb = "Detail";

    public function getHeading(): string|Htmlable
    {
        return 'Detail Barang ' . $this->record->nama_barang;
    }
}
