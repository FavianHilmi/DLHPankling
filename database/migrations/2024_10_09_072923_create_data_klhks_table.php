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
        Schema::create('data_klhks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('tanggal');
            $table->float('SO2');
            $table->float('CO');
            $table->float('O3');
            $table->float('NO2');
            $table->float('HC');
            $table->float('PM10');
            $table->float('PM2_5');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['Sedang Diajukan','Terverifikasi','Perlu Revisi'])->default('Sedang Diajukan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_klhks');
    }
};