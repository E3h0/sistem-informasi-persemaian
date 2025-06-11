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
        Schema::create('mutasi_bibit', function (Blueprint $table) {
            $table->id();
            $table->foreignId("bibit_id")->unique()->constrained("persediaan_bibit");
            $table->foreignId('user_id')->constrained('users');
            $table->integer("gha1");
            $table->integer("gha2");
            $table->integer("gha3");
            $table->integer("gha4");
            $table->integer("aha1");
            $table->integer("aha2");
            $table->integer("aha3");
            $table->integer("aha4");
            $table->integer("oga1");
            $table->integer("oga2");
            $table->integer("oga3");
            $table->integer("oga4");
            $table->integer("siap_distribusi")->nullable();
            $table->string("keterangan")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_bibit');
    }
};
