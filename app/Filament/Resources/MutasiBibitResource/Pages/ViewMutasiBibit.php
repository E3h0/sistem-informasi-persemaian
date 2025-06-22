<?php

namespace App\Filament\Resources\MutasiBibitResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\MutasiBibitResource;

class ViewMutasiBibit extends ViewRecord
{
    protected static string $resource = MutasiBibitResource::class;
    protected static ?string $breadcrumb = "Detail";

    public function getHeading(): string|Htmlable
    {
        return 'Detail Bibit ' . $this->record->bibit->jenis_bibit;
    }
}
