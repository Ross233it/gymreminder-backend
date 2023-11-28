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
        Schema::create('gym_exercises_user_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('session_id');
            $table->foreignId('exercise_id');
            $table->timestamp('date');
            $table->tinyInteger('series')->unsigned();
            $table->tinyInteger('repetitions')->unsigned();
            $table->smallInteger('weight')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_exercises_user_data');
    }
};
