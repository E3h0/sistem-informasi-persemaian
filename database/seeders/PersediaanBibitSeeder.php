<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PersediaanBibit;

class PersediaanBibitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        PersediaanBibit::create([
            'jenis_bibit' => 'Sengon',
            'kategori_bibit_id' => 1,
            'jumlah_persediaan' => 1300000,
            'pemasok' => 'PT. Unison',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Balsa',
            'kategori_bibit_id' => 1,
            'jumlah_persediaan' => 100000,
            'pemasok' => 'PT. Unison',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Pala',
            'kategori_bibit_id' => 1,
            'jumlah_persediaan' => 10000,
            'pemasok' => 'PT. Unison',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Jati',
            'kategori_bibit_id' => 1,
            'jumlah_persediaan' => 100000,
            'pemasok' => 'PT. Unison',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Jati Putih',
            'kategori_bibit_id' => 1,
            'jumlah_persediaan' => 50000,
            'pemasok' => 'PT. Unison',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Mahoni',
            'kategori_bibit_id' => 1,
            'jumlah_persediaan' => 150000,
            'pemasok' => 'PT. Unison',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Manglid',
            'kategori_bibit_id' => 1,
            'jumlah_persediaan' => 50000,
            'pemasok' => 'PT. Makmur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Ketapang Kencana',
            'kategori_bibit_id' => 2,
            'jumlah_persediaan' => 80000,
            'pemasok' => 'PT. Makmur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Glodokan Tiang',
            'kategori_bibit_id' => 2,
            'jumlah_persediaan' => 20000,
            'pemasok' => 'PT. Makmur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Pucuk Merah',
            'kategori_bibit_id' => 2,
            'jumlah_persediaan' => 50000,
            'pemasok' => 'PT. Makmur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Tabebuya',
            'kategori_bibit_id' => 2,
            'jumlah_persediaan' => 50000,
            'pemasok' => 'PT. Makmur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Durian',
            'kategori_bibit_id' => 3,
            'jumlah_persediaan' => 150000,
            'pemasok' => 'PT. Makmur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Jengkol',
            'kategori_bibit_id' => 3,
            'jumlah_persediaan' => 150000,
            'pemasok' => 'PT. Subur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Alpukat',
            'kategori_bibit_id' => 3,
            'jumlah_persediaan' => 100000,
            'pemasok' => 'PT. Subur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Petai',
            'kategori_bibit_id' => 3,
            'jumlah_persediaan' => 400000,
            'pemasok' => 'PT. Subur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Jambu Biji Merah',
            'kategori_bibit_id' => 3,
            'jumlah_persediaan' => 200000,
            'pemasok' => 'PT. Subur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Sirsak',
            'kategori_bibit_id' => 3,
            'jumlah_persediaan' => 200000,
            'pemasok' => 'PT. Subur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Nangka',
            'kategori_bibit_id' => 3,
            'jumlah_persediaan' => 200000,
            'pemasok' => 'PT. Subur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
        PersediaanBibit::create([
            'jenis_bibit' => 'Salam',
            'kategori_bibit_id' => 3,
            'jumlah_persediaan' => 100000,
            'pemasok' => 'PT. Subur',
            'user_id' => 1,
            'tanggal_pembelian' => now(),
            'keterangan' => '',
        ]);
    }
}
