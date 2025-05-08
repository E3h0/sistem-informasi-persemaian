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
        Schema::create('target_produksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId("bibit_id")->constrained("persediaan_bibit");
            $table->integer("target_produksi");
            $table->integer("sudah_diproduksi");
            $table->integer("sudah_distribusi");
            $table->integer("stok_akhir");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_produksi');
    }
};
