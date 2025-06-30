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
        Schema::table('persediaan_alat_kerja', function (Blueprint $table) {
            $table->foreignId("satuan_id")->constrained("satuan_alat_kerja");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persediaan_alat_kerja', function (Blueprint $table) {
            //
        });
    }
};
