<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class MutasiBibitChart extends ChartWidget
{
    protected static ?string $heading = 'Mutasi Bibit';
    protected static bool $isDiscovered = false;
    protected static ?string $description = 'Menunjukkan total persebaran bibit di masing-masing area.';
    protected function getData(): array
    {
        $Gha = DB::table('mutasi_bibit')
        ->selectRaw('SUM(gha1 + gha2 + gha3 + gha4) as gha')
        ->value('gha');

        $aha = DB::table('mutasi_bibit')
        ->selectRaw('SUM(aha1 + aha2 + aha3 + aha4) as aha')
        ->value('aha');

        $oga = DB::table('mutasi_bibit')
        ->selectRaw('SUM(oga1 + oga2 + oga3 + oga4) as oga')
        ->value('oga');

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [$Gha, $aha, $oga],
                    'backgroundColor'=> [
                        'oklch(57.7% 0.245 27.325)',
                        'oklch(55.8% 0.288 302.321)',
                        'oklch(54.6% 0.245 262.881)'
                    ],
                ],
            ],
            'labels' => ['GHA', 'AHA', 'OGA'],
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
