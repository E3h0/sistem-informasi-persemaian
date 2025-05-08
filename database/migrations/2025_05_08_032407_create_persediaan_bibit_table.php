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
            $table->string("jenis_bibit");
            $table->foreignId('kategori_bibit_id')->references('id')->on('kategori_bibit');
            $table->integer("jumlah_persediaan");
            $table->string("keterangan")->nullable();
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
