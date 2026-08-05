<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ganti nama tabel jadi t_post
        Schema::create('t_post', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel t_category
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('t_category') // Arahkan ke tabel t_category
                  ->nullOnDelete();
            
            // Pilihan jenis konten (hardcode)
            $table->enum('type', ['berita', 'artikel'])->default('berita');
            
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->string('cover_image', 255)->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('author_name', 100)->default('Humas BHS');
            
            $table->boolean('is_spotlight')->default(false);
            $table->boolean('is_featured')->default(false);
            
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_post');
    }
};