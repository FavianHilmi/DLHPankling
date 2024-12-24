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
        Schema::create('data_partikulats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_lokasi');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('tahun');
            $table->float('TPM');
            $table->float('PM10');
            $table->float('PM2_5');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kawasan_id')->nullable()->constrained('data_kawasans')->onDelete('set null');
            $table->enum('status', ['Sedang Diajukan','Terverifikasi','Perlu Revisi'])->default('Sedang Diajukan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_partikulats');
    }
};
