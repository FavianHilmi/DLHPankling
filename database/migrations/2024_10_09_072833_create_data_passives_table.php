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
            Schema::create('data_passives', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->date('pemasangan');
                $table->date('pelepasan');
                $table->string('semester');
                $table->string('lokasi');
                $table->foreignId('kawasan_id')->nullable()->constrained('data_kawasans')->onDelete('set null');
                $table->string('longitude')->nullable();
                $table->string('latitude')->nullable();
                $table->float('SO2');
                $table->float('NO2');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->enum('status', ['Sedang Diajukan', 'Terverifikasi', 'Perlu Revisi'])->default('Sedang Diajukan');
            });
        }



        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('data_passives');
        }
    };
