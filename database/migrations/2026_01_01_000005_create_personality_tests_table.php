<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personality_tests', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            // kategori: kepribadian | kecemasan | depresi | stres, dll
            $table->string('kategori')->default('kepribadian');
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('test_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personality_test_id')->constrained('personality_tests')->cascadeOnDelete();
            $table->text('pertanyaan');
            $table->string('dimensi')->nullable()->comment('mis: Ekstrovert/Introvert, atau aspek yang diukur');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('test_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_question_id')->constrained('test_questions')->cascadeOnDelete();
            $table->string('label_jawaban');
            $table->integer('skor')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_options');
        Schema::dropIfExists('test_questions');
        Schema::dropIfExists('personality_tests');
    }
};
