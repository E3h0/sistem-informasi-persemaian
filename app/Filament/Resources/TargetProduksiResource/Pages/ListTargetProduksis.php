<?php

namespace App\Filament\Resources\TargetProduksiResource\Pages;

use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\StaticAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Exports\Models\Export;
use App\Filament\Exports\TargetProduksiExporter;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Resources\TargetProduksiResource;

class ListTargetProduksis extends ListRecords
{
    protected static string $resource = TargetProduksiResource::class;

    protected static ?string $breadcrumb = 'Daftar Target & Realisasi Produksi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Tambah Data Baru"),
            ExportAction::make()->exporter(TargetProduksiExporter::class)
                ->fileName(fn (Export $export): string => "Target&RealisasiProduksi-{$export->getKey()}.xlsx")
                ->formats([ExportFormat::Xlsx])
                ->color('success')
                ->label('Ekspor data')
                ->modalHeading('Ekspor Data Target & Realisasi Produksi')
                ->modalCancelAction(function (StaticAction $action) {
                    $action->label('Batalkan');
                    $action->color('danger');
                })
                ->modalSubmitAction(function (StaticAction $action) {
                    $action->label('Konfirmasi');
                })
                ->modalDescription("Silahkan pilih kolom dan sesuaikan namanya.")
        ];
    }
}
