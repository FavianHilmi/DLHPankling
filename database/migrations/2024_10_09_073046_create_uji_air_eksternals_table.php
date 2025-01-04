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
        Schema::create('uji_air_eksternals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('tanggal');
            $table->string('nama_lokasi');
            // $table->string('wilayah_lokasi');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->float('temperature')->nullable();
            $table->float('TDS')->nullable();
            $table->float('TSS')->nullable();
            $table->float('colour')->nullable();
            $table->float('pH')->nullable();
            $table->float('BOD')->nullable();
            $table->float('COD')->nullable();
            $table->float('DO')->nullable();
            $table->float('sulfate')->nullable();
            $table->float('chloride')->nullable();
            $table->float('nitrate')->nullable();
            $table->float('nitrite')->nullable();
            $table->float('ammonia')->nullable();
            $table->float('total_n')->nullable();
            $table->float('total_phosphate')->nullable();
            $table->float('fluoride')->nullable();
            $table->float('sulfide')->nullable();
            $table->float('cyanide')->nullable();
            $table->float('free_chlorine')->nullable();
            $table->float('boron')->nullable();
            $table->float('mercury')->nullable();
            $table->float('arsenic')->nullable();
            $table->float('selenium')->nullable();
            $table->float('cadmium')->nullable();
            $table->float('cobalt')->nullable();
            $table->float('nickel')->nullable();
            $table->float('zinc')->nullable();
            $table->float('copper')->nullable();
            $table->float('lead')->nullable();
            $table->float('hexavalent_chromium')->nullable();
            $table->float('oil_and_grease')->nullable();
            $table->float('surfactants')->nullable();
            $table->float('phenol')->nullable();
            $table->float('fecal_coli')->nullable();
            $table->float('total_coli')->nullable();
            $table->float('waste')->nullable();
            $table->string('isMarker')->default('0');
            $table->enum('status', ['Sedang Diajukan', 'Terverifikasi', 'Perlu Revisi'])->default('Sedang Diajukan');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uji_air_eksternals');
    }
};
