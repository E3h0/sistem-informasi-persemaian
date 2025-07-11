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
        Schema::create('persediaan_bibit', function (Blueprint $table) {
            $table->id();
            $table->string("jenis_bibit")->unique();
            $table->foreignId("kategori_bibit_id")->constrained("kategori_bibit");
            $table->integer("jumlah_persediaan");
            $table->string("pemasok")->nullable();
            $table->date('tanggal_pembelian');
            $table->string("keterangan")->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaan_bibit');
    }
};
