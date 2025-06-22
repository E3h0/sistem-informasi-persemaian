<?php

namespace App\Filament\Resources\PenggunaanPupukResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\PenggunaanPupukResource;

class ViewPenggunaanPupuk extends ViewRecord
{
    protected static string $resource = PenggunaanPupukResource::class;
    protected static ?string $breadcrumb = "Detail";

    public function getHeading(): string|Htmlable
    {
        return 'Detail Penggunaan Pupuk ' . $this->record->pupuk->nama_pupuk;
    }
}
