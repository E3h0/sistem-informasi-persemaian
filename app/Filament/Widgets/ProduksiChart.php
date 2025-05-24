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
                        'rgb(245 158 11)',
                        'rgb(220 38 38)',
                        'rgb(74 222 128)'
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
