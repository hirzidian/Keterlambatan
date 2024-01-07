<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lates', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time_late');
            $table->text('information');
            $table->text('bukti');
            $table->timestamps();
            $table->unsignedBigInteger('student_id');

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lates');
    }
};
