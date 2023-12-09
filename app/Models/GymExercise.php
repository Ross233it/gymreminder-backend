<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class GymExercise extends Model
{
    protected $table = 'gym_exercises';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'deleted_at'
    ];

    /************************************
     *                                  *
     *            Relations             *
     *                                  *
     ************************************/
    /**
     * Retrieve all medias related to exercise"
     */
    public function appMedia(){
        return $this->hasMany(AppMedia::class, 'exercise_id', 'id');
    }

    /**
     * Retrieve all trainer's suggested data for the exercise"
     */
    public function exerciseDetails(){
        return $this->hasMany(GymExercisesDetails::class, 'exercise_id', 'id');
    }

    /**
     * Retrieve all the cards where the exercise is scheduled."
     */
    public function gymSchedules(){
        return $this->belongsToMany(GymSchedule::class, 'gym_exercises_lookup', 'gym_schedules_id', 'gym_exercises_id');
    }
}
