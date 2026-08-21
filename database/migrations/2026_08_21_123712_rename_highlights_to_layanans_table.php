<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('highlights', 'layanans');
    }

    public function down()
    {
        Schema::rename('layanans', 'highlights');
    }
};