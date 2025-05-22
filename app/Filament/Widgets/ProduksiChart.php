<?php

namespace App\Filament\Widgets;

use App\Models\TargetProduksi;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProduksiChart extends ChartWidget
{
    protected static ?string $heading = 'Realisasi Produksi';
    protected static bool $isDiscovered = false;
    protected static bool $isLazy = false;
    protected static ?string $description = 'Menunjukkan jumlah bibit yang sudah diproduksi, didistribusi dan sisanya.';
    protected function getData(): array
    {

        $realisasi_produksi = TargetProduksi::sum('sudah_diproduksi');
        $realisasi_distribusi = TargetProduksi::sum('sudah_distribusi');
        $sisa_stok = TargetProduksi::sum('stok_akhir');

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [$realisasi_produksi, $realisasi_distribusi, $sisa_stok],
                    'backgroundColor'=> [
                        'oklch(57.7% 0.245 27.325)',
                        'oklch(55.8% 0.288 302.321)',
                        'oklch(54.6% 0.245 262.881)'
                    ],
                ],
            ],
            'labels' => ['Bibit Diproduksi', 'Bibit Didistribusi', 'Bibit Sisa'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

     protected static ?array $options = [
        'scales' => [
            'x' => [
                'display' => false
            ],
            'y' => [
                'display' => false
            ],
        ],
        'plugins' => [
            'legend' => [
                'display' => true,
            ],
            'tooltip' => [
                'enabled' => true
            ]
        ],
    ];
}
