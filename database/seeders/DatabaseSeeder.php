<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KategoriBibitSeeder::class,
            PersediaanBibitSeeder::class,
            TargetProduksiSeeder::class,
            MutasiBibitSeeder::class,
            KategoriAlatKerjaSeeder::class,
            PersediaanAlatKerjaSeeder::class,
            KategoriPupukSeeder::class,
            SatuanPupukSeeder::class,
            BentukPupukSeeder::class,
            PupukSeeder::class,
            KategoriPestisidaSeeder::class,
            SatuanPestisidaSeeder::class,
            BentukPestisidaSeeder::class,
            PestisidaSeeder::class
        ]);
    }
}
