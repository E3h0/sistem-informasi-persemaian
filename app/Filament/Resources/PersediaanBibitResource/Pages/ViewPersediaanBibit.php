<?php

namespace App\Filament\Resources\PersediaanBibitResource\Pages;

use App\Filament\Resources\PersediaanBibitResource;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewPersediaanBibit extends ViewRecord
{
    protected static string $resource = PersediaanBibitResource::class;
    protected static ?string $breadcrumb = "Detail";

    public function getHeading(): string|Htmlable
    {
        return 'Detail Bibit ' . $this->record->jenis_bibit;
    }
}
