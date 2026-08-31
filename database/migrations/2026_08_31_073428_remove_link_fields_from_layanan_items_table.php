<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('layanan_items', function (Blueprint $table) {
        $table->dropColumn(['link_1', 'link_2']);
    });
}

public function down(): void
{
    Schema::table('layanan_items', function (Blueprint $table) {
        $table->string('link_1')->nullable();
        $table->string('link_2')->nullable();
    });
}
};
