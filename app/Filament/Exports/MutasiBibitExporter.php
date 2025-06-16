<?php

namespace App\Filament\Exports;

use App\Models\MutasiBibit;
use Illuminate\Support\Carbon;
use Filament\Actions\Exports\Exporter;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Common\Entity\Style\Border;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;
use OpenSpout\Common\Entity\Style\BorderPart;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\CellVerticalAlignment;

class MutasiBibitExporter extends Exporter
{
    protected static ?string $model = MutasiBibit::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('bibit.jenis_bibit')->label('Jenis Bibit'),
            ExportColumn::make('gha1')->label('GHA Blok 1'),
            ExportColumn::make('gha2')->label('GHA Blok 2'),
            ExportColumn::make('gha3')->label('GHA Blok 3'),
            ExportColumn::make('gha4')->label('GHA Blok 4'),
            ExportColumn::make('aha1')->label('AHA Blok 1'),
            ExportColumn::make('aha2')->label('AHA Blok 2'),
            ExportColumn::make('aha3')->label('AHA Blok 3'),
            ExportColumn::make('aha4')->label('AHA Blok 4'),
            ExportColumn::make('oga1')->label('OGA Blok 1'),
            ExportColumn::make('oga2')->label('OGA Blok 2'),
            ExportColumn::make('oga3')->label('OGA Blok 3'),
            ExportColumn::make('oga4')->label('OGA Blok 4'),
            ExportColumn::make('siap_distribusi')->label('Siap Distribusi'),
            ExportColumn::make('keterangan')->label('Keterangan'),
            ExportColumn::make('pencatat.name')->label('Pencatat'),
            ExportColumn::make('created_at')->label('Dibuat Pada')->formatStateUsing(function ($state) {
                return Carbon::parse($state)->translatedFormat('l, j F Y');
            }),
            ExportColumn::make('updated_at')->label('Diperbarui Pada')->formatStateUsing(function ($state) {
                return Carbon::parse($state)->translatedFormat('l, j F Y');
            }),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Proses eskpor mutasi bibit sudah selesai dan ' . number_format($export->successful_rows) . ' baris sudah diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getXlsxCellStyle(): ?Style
    {
        $border = new Border(
            new BorderPart(Border::TOP, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::RIGHT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::BOTTOM, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::LEFT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
        );

        return (new Style())
            ->setFontSize(12)
            ->setShouldWrapText()
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setBorder($border);
    }

    public function getXlsxHeaderCellStyle(): ?Style
    {
        $border = new Border(
            new BorderPart(Border::TOP, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::RIGHT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::BOTTOM, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::LEFT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
        );

        return (new Style())
            ->setBorder($border)
            ->setShouldWrapText()
            ->setFontBold()
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setBackgroundColor(Color::LIGHT_GREEN);
    }
}
