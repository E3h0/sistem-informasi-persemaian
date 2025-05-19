<?php

use App\Models\Pupuk;
use App\Models\BentukPupuk;
use App\Models\MutasiBibit;
use App\Models\SatuanPupuk;
use App\Models\KategoriBibit;
use App\Models\KategoriPupuk;
use App\Models\TargetProduksi;
use App\Models\BentukPestisida;
use App\Models\PersediaanBibit;
use App\Models\SatuanPestisida;
use App\Models\KategoriAlatKerja;
use App\Models\KategoriPestisida;
use Database\Seeders\PupukSeeder;
use Illuminate\Support\Facades\DB;
use App\Models\PersediaanAlatKerja;
use App\Models\Pestisida;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\PestisidaSeeder;
use Database\Seeders\BentukPupukSeeder;
use Database\Seeders\MutasiBibitSeeder;
use Database\Seeders\SatuanPupukSeeder;
use Database\Seeders\KategoriBibitSeeder;
use Database\Seeders\KategoriPupukSeeder;
use Database\Seeders\TargetProduksiSeeder;
use Database\Seeders\BentukPestisidaSeeder;
use Database\Seeders\PersediaanBibitSeeder;
use Database\Seeders\SatuanPestisidaSeeder;
use Database\Seeders\KategoriAlatKerjaSeeder;
use Database\Seeders\KategoriPestisidaSeeder;
use Database\Seeders\PersediaanAlatKerjaSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

test("Memastikan MutasiBibitSeeder dapat berjalan dengan baik", function () {

    DB::table("kategori_bibit")->truncate();
    DB::table("persediaan_bibit")->truncate();

    $this->seed(KategoriBibitSeeder::class);
    $this->seed(PersediaanBibitSeeder::class);

    $this->seed(MutasiBibitSeeder::class);

    expect(MutasiBibit::count())->toBeGreaterThan(0);
});

test('Memastikan KategoriAlatKerjaSeeder dapat berjalan dengan baik', function () {

    $this->seed(KategoriAlatKerjaSeeder::class);

    expect(KategoriAlatKerja::count())->toBeGreaterThan(0);
});

test('Memastikan PersediaanAlatKerjaSeeder dapat berjalan dengan baik', function () {

    DB::table("kategori_alat_kerja")->truncate();

    $this->seed(KategoriAlatKerjaSeeder::class);
    $this->seed(PersediaanAlatKerjaSeeder::class);

    expect(PersediaanAlatKerja::count())->toBeGreaterThan(0);
});

test('Memastikan KategoriPupukSeeder dapat berjalan dengan baik', function() {

    $this->seed(KategoriPupukSeeder::class);

    expect(KategoriPupuk::count())->toBeGreaterThan(0);

});

test('Memastikan SatuanPupukSeeder dapat berjalan dengan baik', function() {

    $this->seed(SatuanPupukSeeder::class);

    expect(SatuanPupuk::count())->toBeGreaterThan(0);

});

test('Memastikan BentukPupukSeeder dapat berjalan dengan baik', function() {

    $this->seed(BentukPupukSeeder::class);

    expect(BentukPupuk::count())->toBeGreaterThan(0);

});

test('Memastikan PupukSeeder dapat berjalan dengan baik', function() {

    DB::table("kategori_pupuk")->truncate();
    DB::table("satuan_pupuk")->truncate();
    DB::table("bentuk_pupuk")->truncate();

    $this->seed(KategoriPupukSeeder::class);
    $this->seed(SatuanPupukSeeder::class);
    $this->seed(BentukPupukSeeder::class);
    $this->seed(PupukSeeder::class);

    expect(Pupuk::count())->toBeGreaterThan(0);

});

test('Memastikan KategoriPestisidaSeeder dapat berjalan dengan baik', function() {

    $this->seed(KategoriPestisidaSeeder::class);

    expect(KategoriPestisida::count())->toBeGreaterThan(0);

});

test('Memastikan SatuanPestisidaSeeder dapat berjalan dengan baik', function() {

    $this->seed(SatuanPestisidaSeeder::class);

    expect(SatuanPestisida::count())->toBeGreaterThan(0);

});

test('Memastikan BentukPestisidaSeeder dapat berjalan dengan baik', function() {

    $this->seed(BentukPestisidaSeeder::class);

    expect(BentukPestisida::count())->toBeGreaterThan(0);

});

test('Memastikan PestisidaSeeder dapat berjalan dengan baik', function() {

    DB::table("kategori_pestisida")->truncate();
    DB::table("satuan_pestisida")->truncate();
    DB::table("bentuk_pestisida")->truncate();

    $this->seed(KategoriPestisidaSeeder::class);
    $this->seed(SatuanPestisidaSeeder::class);
    $this->seed(BentukPestisidaSeeder::class);
    $this->seed(PestisidaSeeder::class);

    expect(Pestisida::count())->toBeGreaterThan(0);

});
test("Memastikan DatabaseSeeder dapat berjalan dengan baik", function() {

    DB::table("kategori_bibit")->truncate();
    DB::table("persediaan_bibit")->truncate();
    DB::table("kategori_alat_kerja")->truncate();
    DB::table("kategori_pestisida")->truncate();
    DB::table("satuan_pestisida")->truncate();
    DB::table("bentuk_pestisida")->truncate();
    DB::table("kategori_pupuk")->truncate();
    DB::table("satuan_pupuk")->truncate();
    DB::table("bentuk_pupuk")->truncate();

    $this->seed(DatabaseSeeder::class);

    expect(KategoriBibit::count())->toBeGreaterThan(0);
    expect(PersediaanBibit::count())->toBeGreaterThan(0);
    expect(TargetProduksi::count())->toBeGreaterThan(0);
    expect(MutasiBibit::count())->toBeGreaterThan(0);
    expect(KategoriAlatKerja::count())->toBeGreaterThan(0);
    expect(PersediaanAlatKerja::count())->toBeGreaterThan(0);
    expect(KategoriPupuk::count())->toBeGreaterThan(0);
    expect(SatuanPupuk::count())->toBeGreaterThan(0);
    expect(BentukPupuk::count())->toBeGreaterThan(0);
    expect(Pupuk::count())->toBeGreaterThan(0);
    expect(KategoriPestisida::count())->toBeGreaterThan(0);
    expect(SatuanPestisida::count())->toBeGreaterThan(0);
    expect(BentukPestisida::count())->toBeGreaterThan(0);
    expect(Pestisida::count())->toBeGreaterThan(0);
});
