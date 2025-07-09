<?php

namespace App\Filament\Resources\PestisidaResource\Pages;

use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\StaticAction;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Exports\PestisidaExporter;
use Filament\Actions\Exports\Models\Export;
use App\Filament\Resources\PestisidaResource;
use Filament\Actions\Exports\Enums\ExportFormat;

class ListPestisidas extends ListRecords
{
    protected static string $resource = PestisidaResource::class;
    protected static ?string $title = 'Persediaan Pestisida';
    protected static ?string $breadcrumb = "Daftar Pestisida";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data Baru'),
            ExportAction::make()->exporter(PestisidaExporter::class)
                ->fileName(fn (Export $export): string => "Pestisida-{$export->getKey()}.xlsx")
                ->formats([ExportFormat::Xlsx])
                ->color('success')
                ->label('Ekspor data')
                ->modalHeading('Ekspor Data Pestisida')
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
