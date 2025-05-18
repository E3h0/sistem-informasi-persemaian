<?php

namespace App\Filament\Resources\MutasiBibitResource\Pages;

use App\Filament\Resources\MutasiBibitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMutasiBibit extends EditRecord
{
    protected static string $resource = MutasiBibitResource::class;

    protected static ?string $title = 'Edit Data Mutasi Bibit';

    protected static ?string $breadcrumb = 'Edit Data Target Produksi';

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label('Simpan Perubahan'),
            $this->getCancelFormAction()->label('Batalkan')
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }
}
