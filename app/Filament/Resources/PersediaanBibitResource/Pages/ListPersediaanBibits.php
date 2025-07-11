<?php

namespace App\Filament\Resources\PersediaanBibitResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\ExportAction;
use Filament\Actions\StaticAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Exports\PersediaanBibitExporter;
use Filament\Actions\Exports\Jobs\CreateXlsxFile;
use App\Filament\Resources\PersediaanBibitResource;
use Illuminate\Support\Facades\Auth;

class ListPersediaanBibits extends ListRecords
{
    protected static string $resource = PersediaanBibitResource::class;
    protected static ?string $breadcrumb = "Daftar Persediaan Benih";
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Tambah Data Baru"),
            ExportAction::make()->exporter(PersediaanBibitExporter::class)
                ->fileName(fn (Export $export): string => "PersediaanBibit-{$export->getKey()}.xlsx")
                ->formats([ExportFormat::Xlsx])
                ->color('success')
                ->label('Ekspor data')
                ->modalHeading('Ekspor Data Persediaan Benih')
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
