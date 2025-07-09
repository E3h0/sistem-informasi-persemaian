<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('persediaan_alat_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang')->unique();
            $table->foreignId('kategori_id')->constrained('kategori_alat_kerja');
            $table->foreignId("satuan_id")->constrained("satuan_alat_kerja");
            $table->integer('jumlah_persediaan');
            $table->integer('jumlah_dipakai');
            $table->string('keterangan')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaan_alat_kerja');
    }
};
