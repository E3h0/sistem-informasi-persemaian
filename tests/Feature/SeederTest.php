<?php

use App\Models\AreaPenanaman;
use App\Models\BlokPenanaman;
use Database\Seeders\KategoriBibitSeeder;
use Database\Seeders\PersediaanBibitSeeder;
use App\Models\KategoriBibit;
use App\Models\MutasiBibit;
use App\Models\PersediaanBibit;
use App\Models\TargetProduksi;
use Database\Seeders\AreaPenanamanSeeder;
use Database\Seeders\BlokPenanamanSeeder;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\MutasiBibitSeeder;
use Database\Seeders\TargetProduksiSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

// Refresh Db
uses(RefreshDatabase::class);

test('Memastikan KategoriBibitSeeder dapat berjalan dengan baik', function () {

    // jalankan seeder
    $this->seed(KategoriBibitSeeder::class);

    // konfirmasi data di database
    expect(KategoriBibit::count())->toBeGreaterThan(0);
});

test('Memastikan PeersediaanBibitSeeder dapat berjalan dengan baik', function () {

    // reset id counter ke 0
    DB::table("kategori_bibit")->truncate();

    $this->seed(KategoriBibitSeeder::class);
    $this->seed(PersediaanBibitSeeder::class);

    expect(PersediaanBibit::count())->toBeGreaterThan(0);
});

test("Memastikan TargetProduksiSeeder dapat berjalan dengan baik", function () {

    DB::table("kategori_bibit")->truncate();
    DB::table("persediaan_bibit")->truncate();

    $this->seed(KategoriBibitSeeder::class);
    $this->seed(PersediaanBibitSeeder::class);
    $this->seed(TargetProduksiSeeder::class);

    expect(TargetProduksi::count())->toBeGreaterThan(0);
});

test("Memastikan AreaPenanamanSeeder dapat berjalan dengan baik", function () {

    $this->seed(AreaPenanamanSeeder::class);

    expect(AreaPenanaman::count())->toBeGreaterThan(0);
});

test("Memastikan BlokPenanamanSeeder dapat berjalan dengan baik", function () {

    $this->seed(BlokPenanamanSeeder::class);

    expect(BlokPenanaman::count())->toBeGreaterThan(0);
});

test("Memastikan MutasiBibitSeeder dapat berjalan dengan baik", function () {

    DB::table("kategori_bibit")->truncate();
    DB::table("persediaan_bibit")->truncate();
    DB::table("area_penanaman")->truncate();
    DB::table("blok_penanaman")->truncate();

    $this->seed(KategoriBibitSeeder::class);
    $this->seed(PersediaanBibitSeeder::class);
    $this->seed(AreaPenanamanSeeder::class);
    $this->seed(BlokPenanamanSeeder::class);

    $this->seed(MutasiBibitSeeder::class);

    expect(MutasiBibit::count())->toBeGreaterThan(0);
});

test("Memastikan DatabaseSeeder dapat berjalan dengan baik", function() {

    DB::table("kategori_bibit")->truncate();
    DB::table("persediaan_bibit")->truncate();
    DB::table("area_penanaman")->truncate();
    DB::table("blok_penanaman")->truncate();

    $this->seed(DatabaseSeeder::class);
    
    expect(KategoriBibit::count())->toBeGreaterThan(0);
    expect(PersediaanBibit::count())->toBeGreaterThan(0);
    expect(TargetProduksi::count())->toBeGreaterThan(0);
    expect(AreaPenanaman::count())->toBeGreaterThan(0);
    expect(BlokPenanaman::count())->toBeGreaterThan(0);
    expect(MutasiBibit::count())->toBeGreaterThan(0);
});
