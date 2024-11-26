<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arsip_data_air_internals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('bulan');
            $table->string('tahun');
            $table->string('nama_lokasi');
            $table->string('titik_koordinat')->nullable();
            $table->float('BOD');
            $table->float('COD');
            $table->float('TSS');
            $table->float('DO');
            $table->float('pH');
            $table->float('total_coli');
            $table->float('fecal_coli');
            $table->enum('status', ['Sedang Diajukan', 'Terverifikasi', 'Perlu Revisi'])->default('Sedang Diajukan');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_data_air_internals');
    }
};
