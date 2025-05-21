<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\MutasiBibitChart;
use App\Filament\Widgets\StatsOverview;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?int $navigationSort = -2;
    protected static ?string $navigationLabel = 'Dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            MutasiBibitChart::class
        ];
    }
}