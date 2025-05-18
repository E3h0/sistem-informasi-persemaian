<?php

namespace App\Filament\Resources\MutasiBibitResource\Pages;

use App\Filament\Resources\MutasiBibitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMutasiBibit extends CreateRecord
{
    protected static string $resource = MutasiBibitResource::class;

    protected static ?string $title = 'Tambah Data Mutasi Bibit';

    protected static ?string $breadcrumb = 'Tambah Data Mutasi Bibit';
}
