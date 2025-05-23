<?php

namespace Database\Seeders;

use App\Models\PenggunaanPupuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaanPupukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PenggunaanPupuk::create([
            'pupuk_id' => 1,
            'jumlah_penggunaan' => 20,
            'tanggal_penggunaan' => now(),
            'user_id' => 1,
            'keterangan' => 'keterangan',
        ]);
    }
}
