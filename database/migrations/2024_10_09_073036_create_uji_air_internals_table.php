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
        Schema::create('uji_air_internals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('tanggal');
            $table->string('nama_lokasi');
            $table->string('wilayah_lokasi');
            $table->string('titik_koordinat');
            $table->float('pH');
            $table->float('DO');
            $table->float('BOD');
            $table->float('COD');
            $table->float('TSS');
            $table->float('nitrat');
            $table->float('fosfat');
            $table->float('fecal_coli');
            $table->float('kelas');
            $table->enum('status', ['Sedang Diajukan','Terverifikasi','Perlu Revisi'])->default('Sedang Diajukan');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uji_air_internals');
    }
};
