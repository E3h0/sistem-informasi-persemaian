<?php

namespace App\Filament\Resources\TargetProduksiResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\TargetProduksiResource;

class ViewTargetProduksi extends ViewRecord
{
    protected static string $resource = TargetProduksiResource::class;
    protected static ?string $breadcrumb = "Detail";
    
    public function getHeading(): string|Htmlable
    {
        return 'Detail Bibit ' . $this->record->jenis_bibit;
    }
}
