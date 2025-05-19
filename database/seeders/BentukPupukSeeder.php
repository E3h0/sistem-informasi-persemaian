<?php

namespace Database\Seeders;

use App\Models\BentukPupuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BentukPupukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BentukPupuk::create(['nama_bentuk' => 'Padat']);
        BentukPupuk::create(['nama_bentuk' => 'Cair']);
    }
}
