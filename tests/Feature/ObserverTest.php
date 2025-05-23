<?php

use App\Models\Pupuk;
use Database\Seeders\UserSeeder;
use Database\Seeders\PupukSeeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\BentukPupukSeeder;
use Database\Seeders\SatuanPupukSeeder;
use Database\Seeders\KategoriPupukSeeder;
use Database\Seeders\PenggunaanPupukSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses (RefreshDatabase::class);
test('Memastikan PenggunaanPupukObserver berjalan dengan baik', function () {


    DB::table("kategori_pupuk")->truncate();
    DB::table("satuan_pupuk")->truncate();
    DB::table("bentuk_pupuk")->truncate();

    $this->seed(UserSeeder::class);
    $this->seed(KategoriPupukSeeder::class);
    $this->seed(SatuanPupukSeeder::class);
    $this->seed(BentukPupukSeeder::class);
    $this->seed(PupukSeeder::class);

    $stok = Pupuk::first();
    $stok_awal = $stok->jumlah_persediaan;
    
    $this->seed(PenggunaanPupukSeeder::class);

    $stok->refresh();

    $this->assertEquals($stok_awal-20, $stok->jumlah_persediaan);

});
