<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rombels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rombel', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rombels');
    }
};
