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
        Schema::create('parameter_spkuas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('O3');
            $table->float('SO2');
            $table->float('NO2');
            $table->float('CO');
            $table->float('PM10');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_spkuas');
    }
};
