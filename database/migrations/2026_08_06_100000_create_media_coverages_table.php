<?php
// database/migrations/2026_08_06_100000_create_media_coverages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_coverages', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // Nama media, misal "Tribun Jabar"
            $table->string('logo')->nullable(); // Path foto/logo di storage
            $table->string('url')->nullable();  // Link berita/media
            $table->integer('order')->default(0); // Urutan tampil di carousel
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_coverages');
    }
};