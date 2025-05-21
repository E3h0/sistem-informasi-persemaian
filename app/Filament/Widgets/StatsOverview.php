<?php

namespace App\Filament\Widgets;

use App\Models\PersediaanBibit;
use App\Models\TargetProduksi;
use Filament\Forms\Components\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected function getStats(): array
    {
        $bibit = PersediaanBibit::count();
        $stok_bibit_total = PersediaanBibit::sum('jumlah_persediaan');

        $target_produksi_total = TargetProduksi::sum('target_produksi');
        $realisasi_produksi = TargetProduksi::sum('sudah_diproduksi');
        $persentase_produksi = ($realisasi_produksi/$target_produksi_total) * 100;
        $realisasi_distribusi = TargetProduksi::sum('sudah_distribusi');
        $persentase_distribusi = ($realisasi_distribusi/$realisasi_produksi) * 100;
        $sisa_stok = TargetProduksi::sum('stok_akhir');
        $persentase_sisa = ($sisa_stok/$realisasi_produksi) * 100;

        return [
            Stat::make('Jenis Bibit', $bibit)->description('Jumlah jenis bibit yang tersedia.'),

            Stat::make('Stok Bibit', number_format($stok_bibit_total, 0, '.', '.'))->description('Jumlah total dari stok bibit.'),

            Stat::make('Target Produksi', number_format($target_produksi_total, 0, '.', '.'))
            ->description('Jumlah total dari target produksi bibit.'),

            Stat::make('Bibit Diproduksi', round($persentase_produksi, 2).'%')->description('Persentase bibit yang diproduksi dari total target produksi.'),

            Stat::make('Bibit Didistribusi', round($persentase_distribusi, 2).'%')->description('Persentase bibit yang telah didistribusikan dari bibit yang telah diproduksi.'),

            Stat::make('Sisa Bibit', round($persentase_sisa, 2).'%')->description('Persentase bibit yang tersisa dari bibit yang sudah diproduksi.'),
        ];
    }

    protected function getColumns(): int
    {
        return 2;
    }
}
