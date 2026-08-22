<?php
// database/migrations/2026_08_15_000000_add_video_fields_to_layanans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('image'); // link YouTube, ditampilkan sbg embed player
        });
    }

    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
             $table->dropColumn('video_url');
        });
    }
};