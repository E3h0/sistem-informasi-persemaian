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
        Schema::create('pupuk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pupuk');
            $table->foreignId("satuan_pupuk_id")->constrained("satuan_pupuk");
            $table->foreignId("bentuk_pupuk_id")->constrained("bentuk_pupuk");
            $table->foreignId("kategori_pupuk_id")->constrained("kategori_pupuk");
            $table->integer('jumlah_persediaan');
            $table->integer('jumlah_dipakai');
            $table->integer('sisa');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pupuk');
    }
};
