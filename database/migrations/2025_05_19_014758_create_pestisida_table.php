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
        Schema::create('pestisida', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pestisida');
            $table->foreignId("satuan_pestisida_id")->constrained("satuan_pestisida");
            $table->foreignId("bentuk_pestisida_id")->constrained("bentuk_pestisida");
            $table->foreignId("kategori_pestisida_id")->constrained("kategori_pestisida");
            $table->integer('jumlah_persediaan');
            $table->integer('jumlah_dipakai');
            $table->integer('sisa');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pestisida');
    }
};
