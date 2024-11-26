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
            $table->string('wilayah_lokasi');
            $table->string('titik_koordinat');

            $table->float('temperature');
            $table->float('TDS'); // Total Dissolved Solids
            $table->float('TSS'); // Total Suspended Solids
            $table->string('colour');
            $table->float('pH');
            $table->float('BOD'); // Biochemical Oxygen Demand
            $table->float('COD'); // Chemical Oxygen Demand
            $table->float('DO'); // Dissolved Oxygen
            $table->float('sulfate');
            $table->float('chloride');
            $table->float('nitrate');
            $table->float('nitrite');
            $table->float('ammonia');
            $table->float('total_n');
            $table->float('total_phosphate');
            $table->float('fluoride');
            $table->float('sulfide');
            $table->float('cyanide');
            $table->float('free_chlorine');
            $table->float('boron');
            $table->float('mercury');
            $table->float('arsenic');
            $table->float('selenium');
            $table->float('cadmium');
            $table->float('cobalt');
            $table->float('nickel');
            $table->float('zinc');
            $table->float('copper');
            $table->float('lead');
            $table->float('hexavalent_chromium');
            $table->float('oil_and_grease');
            $table->float('surfactants');
            $table->float('phenol');
            $table->float('fecal_coli');
            $table->float('total_coli');
            $table->string('waste');

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
