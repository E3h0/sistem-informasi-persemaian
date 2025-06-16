<?php

namespace App\Filament\Resources\PenggunaanPupukResource\Pages;

use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\StaticAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Exports\PenggunaanPupukExporter;
use App\Filament\Resources\PenggunaanPupukResource;

class ListPenggunaanPupuks extends ListRecords
{
    protected static string $resource = PenggunaanPupukResource::class;

    protected static ?string $title = 'Penggunaan Pupuk';

    protected static ?string $breadcrumb = "Daftar Penggunaan Pupuk";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->make()->label('Tambah Data Baru'),
            ExportAction::make()->exporter(PenggunaanPupukExporter::class)
                ->fileName(fn (Export $export): string => "PenggunaanPupuk-{$export->getKey()}.xlsx")
                ->formats([ExportFormat::Xlsx])
                ->color('success')
                ->label('Eskpor data')
                ->modalHeading('Ekspor Data Penggunaan Pupuk')
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
