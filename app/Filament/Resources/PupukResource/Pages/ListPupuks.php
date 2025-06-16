<?php

namespace App\Filament\Resources\PupukResource\Pages;

use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\StaticAction;
use App\Filament\Exports\PupukExporter;
use App\Filament\Resources\PupukResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;

class ListPupuks extends ListRecords
{
    protected static string $resource = PupukResource::class;
    protected static ?string $title = 'Persediaan Pupuk';
    protected static ?string $breadcrumb = "Daftar Pupuk";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data Baru'),
            ExportAction::make()->exporter(PupukExporter::class)
                ->fileName(fn (Export $export): string => "Pupuk-{$export->getKey()}.xlsx")
                ->formats([ExportFormat::Xlsx])
                ->color('success')
                ->label('Eskpor data')
                ->modalHeading('Ekspor Data Pupuk')
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
