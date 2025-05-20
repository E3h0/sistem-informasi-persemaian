<?php

namespace App\Filament\Resources\PupukResource\Pages;

use App\Filament\Resources\PupukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPupuk extends EditRecord
{
    protected static string $resource = PupukResource::class;

    protected static ?string $title = 'Edit Data Pupuk';
    protected static ?string $breadcrumb = "Edit Data Pupuk";
}
