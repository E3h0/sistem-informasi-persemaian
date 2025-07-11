<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriBibit;

class KategoriBibitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBibit::create([
            "nama_kategori" => "Jenis Kayu",
            'user_id' => 1,
            'keterangan' => null
        ]);
        KategoriBibit::create([
            "nama_kategori" => "Tanaman Hias",
            'user_id' => 1,
            'keterangan' => null
        ]);
        KategoriBibit::create([
            "nama_kategori" => "Penghasil Non Kayu",
            'user_id' => 1,
            'keterangan' => null
        ]);
        KategoriBibit::create([
            "nama_kategori" => "Penutup Tanah",
            'user_id' => 1,
            'keterangan' => null
        ]);
        KategoriBibit::create([
            "nama_kategori" => "Tanaman Buah",
            'user_id' => 1,
            'keterangan' => null
        ]);
        KategoriBibit::create([
            "nama_kategori" => "Tanaman Atsiri",
            'user_id' => 1,
            'keterangan' => null
        ]);
        KategoriBibit::create([
            "nama_kategori" => "Rekalsitran",
            'user_id' => 1,
            'keterangan' => null
        ]);
        KategoriBibit::create([
            'nama_kategori'=> 'Ortodoks',
            'user_id' => 1,
            'keterangan' => null
        ]);

    }
}
