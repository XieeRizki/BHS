<?php
// database/migrations/2026_08_13_000000_add_more_layanan_fields_to_highlights_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->string('qr_badge_text')->nullable()->after('qr_gofood');
            $table->string('qr_title')->nullable()->after('qr_badge_text');
            $table->string('cta_title')->nullable()->after('qr_title');
            $table->string('cta_subtitle')->nullable()->after('cta_title');
        });
    }

    public function down(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->dropColumn(['qr_badge_text', 'qr_title', 'cta_title', 'cta_subtitle']);
        });
    }
};