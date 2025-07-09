<?php

namespace App\Filament\Resources\MutasiBibitResource\Pages;

use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\StaticAction;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Exports\Models\Export;
use App\Filament\Exports\MutasiBibitExporter;
use App\Filament\Resources\MutasiBibitResource;
use Filament\Actions\Exports\Enums\ExportFormat;

class ListMutasiBibits extends ListRecords
{
    protected static string $resource = MutasiBibitResource::class;

    protected static ?string $breadcrumb = 'Daftar Mutasi Bibit';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data Baru'),
            ExportAction::make()->exporter(MutasiBibitExporter::class)
                ->fileName(fn (Export $export): string => "MutasiBibit-{$export->getKey()}.xlsx")
                ->formats([ExportFormat::Xlsx])
                ->color('success')
                ->label('Ekspor data')
                ->modalHeading('Ekspor Data Mutasi Bibit')
                ->modalCancelAction(function (StaticAction $action) {
                    $action->label('Batalkan');
                    $action->color('danger');
                })
                ->modalSubmitAction(function (StaticAction $action) {
                    $action->label('Konfirmasi');
                })
                ->modalDescription("Silahkan pilih kolom dan sesuaikan namanya.")
                ->visible(fn (): bool => Auth::user()->isAdmin() || Auth::user()->isEditor())
        ];
    }
}
