<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Questa tabella si occupa di mettere in una relazione molti a molti
 * le risorse multimediali con gli esercizi ginnici.
 *
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('app_media_lookup', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unique();
            $table->foreignId('gym_exercises_id');
            $table->foreignId('app_media_id');
            $table->foreign('gym_exercises_id')->references('id')->on('gym_exercises');
            $table->foreign('app_media_id')->references('id')->on('app_media');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_media_lookup');
    }
};
