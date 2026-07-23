<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('personality_test_id')->constrained('personality_tests')->cascadeOnDelete();
            $table->integer('total_skor')->default(0);
            $table->integer('skor_maksimal')->default(0);
            // persentase hasil tes ini (0-100)
            $table->decimal('persentase', 5, 2)->default(0);
            $table->string('kategori_hasil')->nullable()->comment('mis: Rendah, Sedang, Tinggi / nama tipe kepribadian');
            $table->text('interpretasi')->nullable();
            $table->json('detail_jawaban')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
