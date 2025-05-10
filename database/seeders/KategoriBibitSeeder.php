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
        // $data = [
        //     [
        //         "nama_kategori" => "Kayu-kayuan"
        //     ],
        //     [
        //         "nama_kategori" => "Estetika"
        //     ],
        //     [
        //         "nama_kategori" => "Hasil Hutan Non Kayu"
        //     ],
        // ];

        // KategoriBibit::insert($data);
        
        KategoriBibit::create([
           ["nama_kategori" => "Kayu-kayuan"],
           ["nama_kategori" => "Estetika"],
           ["nama_kategori" => "Hasil Hutan Non Kayu"]
        ]);
    }
}
