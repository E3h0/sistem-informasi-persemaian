<?php

namespace App\Filament\Resources\PestisidaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\PestisidaResource;

class ViewPestisida extends ViewRecord
{
    protected static string $resource = PestisidaResource::class;
    protected static ?string $breadcrumb = "Detail";

    public function getHeading(): string|Htmlable
    {
        return 'Detail Pestisida ' . $this->record->nama_pupuk;
    }
}
