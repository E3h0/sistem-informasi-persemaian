<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TargetProduksi;

class TargetProduksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TargetProduksi::create([
            "bibit_id" => 1,
            "target_produksi" => 1300000,
            "sudah_diproduksi" => 1300000,
            "sudah_distribusi" => 847077,
            "stok_akhir" => 452923
        ]);
        TargetProduksi::create([
            "bibit_id" => 2,
            "target_produksi" => 100000,
            "sudah_diproduksi" => 100000,
            "sudah_distribusi" => 100000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 3,
            "target_produksi" => 10000,
            "sudah_diproduksi" => 10000,
            "sudah_distribusi" => 10000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 4,
            "target_produksi" => 100000,
            "sudah_diproduksi" => 100000,
            "sudah_distribusi" => 100000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 5,
            "target_produksi" => 50000,
            "sudah_diproduksi" => 50000,
            "sudah_distribusi" => 50000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 6,
            "target_produksi" => 150000,
            "sudah_diproduksi" => 150000,
            "sudah_distribusi" => 96224,
            "stok_akhir" => 53776
        ]);
        TargetProduksi::create([
            "bibit_id" => 7,
            "target_produksi" => 50000,
            "sudah_diproduksi" => 50000,
            "sudah_distribusi" => 49896,
            "stok_akhir" => 104
        ]);
        TargetProduksi::create([
            "bibit_id" => 8,
            "target_produksi" => 80000,
            "sudah_diproduksi" => 80000,
            "sudah_distribusi" => 67276,
            "stok_akhir" => 12724
        ]);
        TargetProduksi::create([
            "bibit_id" => 9,
            "target_produksi" => 20000,
            "sudah_diproduksi" => 20000,
            "sudah_distribusi" => 20000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 10,
            "target_produksi" => 50000,
            "sudah_diproduksi" => 50000,
            "sudah_distribusi" => 50000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 11,
            "target_produksi" => 50000,
            "sudah_diproduksi" => 50000,
            "sudah_distribusi" => 50000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 12,
            "target_produksi" => 150000,
            "sudah_diproduksi" => 150000,
            "sudah_distribusi" => 150000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 13,
            "target_produksi" => 150000,
            "sudah_diproduksi" => 150000,
            "sudah_distribusi" => 150000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 14,
            "target_produksi" => 100000,
            "sudah_diproduksi" => 100000,
            "sudah_distribusi" => 100000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 15,
            "target_produksi" => 400000,
            "sudah_diproduksi" => 400000,
            "sudah_distribusi" => 400000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 16,
            "target_produksi" => 200000,
            "sudah_diproduksi" => 200000,
            "sudah_distribusi" => 143485,
            "stok_akhir" => 56515
        ]);
        TargetProduksi::create([
            "bibit_id" => 17,
            "target_produksi" => 200000,
            "sudah_diproduksi" => 200000,
            "sudah_distribusi" => 148591,
            "stok_akhir" => 51409
        ]);
        TargetProduksi::create([
            "bibit_id" => 18,
            "target_produksi" => 200000,
            "sudah_diproduksi" => 200000,
            "sudah_distribusi" => 200000,
            "stok_akhir" => 0
        ]);
        TargetProduksi::create([
            "bibit_id" => 19,
            "target_produksi" => 100000,
            "sudah_diproduksi" => 100000,
            "sudah_distribusi" => 76137,
            "stok_akhir" => 23863
        ]);
    }
}
