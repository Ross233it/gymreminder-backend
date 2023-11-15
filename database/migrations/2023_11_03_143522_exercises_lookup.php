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
        Schema::create('gym_exercises_lookup', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement()->unique();
            $table->foreignId('gym_exercises_id');
            $table->foreignId('gym_schedules_id');
            $table->foreign('gym_exercises_id')->references('id')->on('gym_exercises');
            $table->foreign('gym_schedules_id')->references('id')->on('gym_schedules');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_exercises_lookup');
    }
};
