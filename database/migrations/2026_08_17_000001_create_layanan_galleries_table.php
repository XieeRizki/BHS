<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_id')->constrained('layanans')->cascadeOnDelete();
            $table->foreignId('layanan_kategori_id')->nullable()->constrained('layanan_kategoris')->nullOnDelete();
            $table->string('image');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Kolom 'gallery' (JSON) yang lama sudah digantikan tabel ini, jadi dihapus
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn('gallery');
        });
    }

    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->json('gallery')->nullable();
        });

        Schema::dropIfExists('layanan_galleries');
    }
};
