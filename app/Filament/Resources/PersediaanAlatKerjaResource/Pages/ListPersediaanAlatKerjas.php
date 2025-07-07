<?php

namespace App\Filament\Resources\PersediaanAlatKerjaResource\Pages;

use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\StaticAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Exports\PersediaanAlatKerjaExporter;
use App\Filament\Resources\PersediaanAlatKerjaResource;

class ListPersediaanAlatKerjas extends ListRecords
{
    protected static string $resource = PersediaanAlatKerjaResource::class;
    protected static ?string $title = 'Persediaan Alat Kerja';
    protected static ?string $breadcrumb = "Daftar Alat Kerja";
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data Baru'),
            ExportAction::make()->exporter(PersediaanAlatKerjaExporter::class)
                ->fileName(fn (Export $export): string => "PersediaanAlatKerja-{$export->getKey()}.xlsx")
                ->formats([ExportFormat::Xlsx])
                ->color('success')
                ->label('Ekspor data')
                ->modalHeading('Ekspor Data Persediaan Alat Kerja')
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
