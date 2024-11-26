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
        Schema::create('data_pengujis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_kolom_penguji');
            $table->string('nama_penguji');
            $table->string('instansi');
            $table->foreignId('berita_id')->nullable()->constrained('beritas')->onDelete('cascade');
            $table->string('ttd')->nullable();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn(['nama_kolom_penguji', 'nama_penguji', 'instansi', 'berita_id', 'ttd']);
        });
    }

};
