<?php
// database/migrations/2026_08_16_000000_add_showcase_fields_to_layanans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->string('showcase_title')->nullable()->after('gallery');
            $table->string('showcase_subtitle')->nullable()->after('showcase_title');
            $table->json('showcase_items')->nullable()->after('showcase_subtitle');
            // showcase_items format: [{"category": "Makanan", "name": "Nasi Goreng Kampung", "description": "...", "image": "..."}]
        });
    }

    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn(['showcase_title', 'showcase_subtitle', 'showcase_items']);
        });
    }
};