<?php
// database/migrations/2026_08_12_000000_add_layanan_fields_to_highlights_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->string('hero_subtitle')->nullable()->after('title');
            $table->string('section_subtitle')->nullable()->after('hero_subtitle');
            $table->json('services')->nullable()->after('content'); // [{"name": "SARAPAN PAGI", "image": "..."}]
            $table->json('gallery')->nullable()->after('services');  // ["path1.jpg", "path2.jpg", ...]
            $table->string('qr_shopeefood')->nullable()->after('gallery');
            $table->string('qr_gofood')->nullable()->after('qr_shopeefood');
        });
    }

    public function down(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->dropColumn(['hero_subtitle', 'section_subtitle', 'services', 'gallery', 'qr_shopeefood', 'qr_gofood']);
        });
    }
};