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
        Schema::create('penggunaan_pestisida', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pestisida_id')->constrained('pestisida');
            $table->integer('jumlah_penggunaan');
            $table->date('tanggal_penggunaan');
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_pestisida');
    }
};
