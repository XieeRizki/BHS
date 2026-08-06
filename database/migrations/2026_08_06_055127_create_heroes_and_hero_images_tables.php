<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Utama Hero (Teks & Fallback Image)
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            // Kolom image ini buat fallback kalau slider kosong (sesuai kodingan bladenya)
            $table->string('image')->nullable(); 
            $table->timestamps();
        });

        // 2. Tabel Khusus Gambar Slider (One-to-Many dari heroes)
        Schema::create('hero_images', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel heroes
            $table->foreignId('hero_id')->constrained('heroes')->onDelete('cascade');
            // Nama/Path file gambar slider
            $table->string('image'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Drop child table dulu, baru parent table
        Schema::dropIfExists('hero_images');
        Schema::dropIfExists('heroes');
    }
};