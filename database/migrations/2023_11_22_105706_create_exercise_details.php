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
        Schema::create('gym_exercises_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('schedule_id');
            $table->foreignId('session_id');
            $table->foreignId('exercise_id');
            $table->tinyInteger('suggested_series');
            $table->tinyInteger('suggested_repetitions');
            $table->tinyInteger('suggested_weight');
            $table->unique(["user_id", "schedule_id", "session_id", "exercise_id"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_exercises_details');
    }
};
