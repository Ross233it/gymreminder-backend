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
        Schema::create('gym_schedules_lookup', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('gym_schedules_id');
            $table->boolean('is_active')->default(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('gym_schedules_id')->references('id')->on('gym_schedules');
            $table->unique(['user_id', 'gym_schedules_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_schedules_lookup');
    }
};
