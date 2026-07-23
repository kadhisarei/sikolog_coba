<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
            $table->date('tanggal_konsultasi');
            $table->time('jam_konsultasi');
            $table->enum('metode', ['chat', 'video_call', 'tatap_muka'])->default('chat');
            $table->text('keluhan')->nullable();
            // status: pending -> dikonfirmasi -> berlangsung -> selesai / dibatalkan
            $table->enum('status', ['pending', 'dikonfirmasi', 'berlangsung', 'selesai', 'dibatalkan'])->default('pending');
            $table->text('catatan_dokter')->nullable();
            $table->unsignedTinyInteger('rating')->nullable()->comment('1-5 dari user setelah konsultasi selesai');
            $table->text('ulasan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
