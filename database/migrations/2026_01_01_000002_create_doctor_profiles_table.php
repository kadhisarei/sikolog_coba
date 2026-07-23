<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // jenis: psikolog | psikiater
            $table->enum('jenis', ['psikolog', 'psikiater']);
            $table->string('str_number')->nullable()->comment('No. STR / izin praktik');
            $table->string('spesialisasi')->nullable();
            $table->unsignedInteger('pengalaman_tahun')->default(0);
            $table->text('bio')->nullable();
            $table->decimal('tarif_konsultasi', 12, 2)->default(0);
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_profiles');
    }
};
