<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_id')->constrained('layanans')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->decimal('price', 12, 2)->nullable();
            $table->string('price_unit')->nullable();
            $table->text('description')->nullable();
            $table->string('sub_title_1')->nullable();
            $table->text('sub_description_1')->nullable();
            $table->string('sub_title_2')->nullable();
            $table->text('sub_description_2')->nullable();
            $table->string('pdf')->nullable();
            $table->string('link_1')->nullable();
            $table->string('link_2')->nullable();
            $table->string('cover')->nullable();
            $table->json('gallery')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_items');
    }
};