<?php

use App\Models\Pestisida;
use App\Models\Pupuk;
use Database\Seeders\BentukPestisidaSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PupukSeeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\BentukPupukSeeder;
use Database\Seeders\KategoriPestisidaSeeder;
use Database\Seeders\SatuanPupukSeeder;
use Database\Seeders\KategoriPupukSeeder;
use Database\Seeders\PenggunaanPestisidaSeeder;
use Database\Seeders\PenggunaanPupukSeeder;
use Database\Seeders\PestisidaSeeder;
use Database\Seeders\SatuanPestisidaSeeder;
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

test('Memastikan PenggunaanPestisidaObserver berjalan dengan baik', function () {


    DB::table("kategori_pestisida")->truncate();
    DB::table("satuan_pestisida")->truncate();
    DB::table("bentuk_pestisida")->truncate();
    DB::table("users")->truncate();

    $this->seed(UserSeeder::class);
    $this->seed(KategoriPestisidaSeeder::class);
    $this->seed(SatuanPestisidaSeeder::class);
    $this->seed(BentukPestisidaSeeder::class);
    $this->seed(PestisidaSeeder::class);

    $stok = Pestisida::first();
    $stok_awal = $stok->jumlah_persediaan;

    $this->seed(PenggunaanPestisidaSeeder::class);

    $stok->refresh();

    $this->assertEquals($stok_awal-20, $stok->jumlah_persediaan);

});
