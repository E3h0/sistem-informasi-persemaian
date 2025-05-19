<?php

namespace Database\Seeders;

use App\Models\BentukPestisida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BentukPestisidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BentukPestisida::create(['nama_bentuk' => 'Padat']);
        BentukPestisida::create(['nama_bentuk' => 'Cair']);
    }
}
