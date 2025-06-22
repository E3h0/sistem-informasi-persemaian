<?php

namespace App\Filament\Resources\PupukResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\PupukResource;
use Illuminate\Contracts\Support\Htmlable;

class ViewPupuk extends ViewRecord
{
    protected static string $resource = PupukResource::class;
    protected static ?string $breadcrumb = "Detail";

    public function getHeading(): string|Htmlable
    {
        return 'Detail Pupuk ' . $this->record->nama_pupuk;
    }
}
