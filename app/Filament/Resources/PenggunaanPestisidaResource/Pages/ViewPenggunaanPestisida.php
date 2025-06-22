<?php

namespace App\Filament\Resources\PenggunaanPestisidaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\PenggunaanPestisidaResource;

class ViewPenggunaanPestisida extends ViewRecord
{
    protected static string $resource = PenggunaanPestisidaResource::class;

    protected static ?string $breadcrumb = "Detail";

    public function getHeading(): string|Htmlable
    {
        return 'Detail Penggunaan Pestisida ' . $this->record->pestisida->nama_pestisida;
    }
}
