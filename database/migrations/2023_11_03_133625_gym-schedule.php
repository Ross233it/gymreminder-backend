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
        //TODO Add validation dates - begin date -end date
        Schema::create('gym_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name',35)->unique();
            $table->tinyInteger('gym_sesssion');
            $table->string('description', 150)->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('gym_schedules');
    }
};
