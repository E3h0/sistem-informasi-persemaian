<?php

namespace App\Filament\Resources\PenggunaanPestisidaResource\Pages;

use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\StaticAction;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Exports\PenggunaanPestisidaExporter;
use App\Filament\Resources\PenggunaanPestisidaResource;

class ListPenggunaanPestisidas extends ListRecords
{
    protected static string $resource = PenggunaanPestisidaResource::class;

    protected static ?string $title = 'Penggunaan Pestisida';

    protected static ?string $breadcrumb = "Daftar Penggunaan Pestisida";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->make()->label('Tambah Data Baru'),
            ExportAction::make()->exporter(PenggunaanPestisidaExporter::class)
                ->fileName(fn (Export $export): string => "PersediaanBibit-{$export->getKey()}.xlsx")
                ->formats([ExportFormat::Xlsx])
                ->color('success')
                ->label('Ekspor data')
                ->modalHeading('Ekspor Data Persediaan Bibit')
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
