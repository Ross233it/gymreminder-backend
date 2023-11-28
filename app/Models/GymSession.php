<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymSession extends Model
{
    protected $table = "gym_sessions";

    protected $fillable = [
        'name',
        'description',
        'gym_schedules_id'
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

    public function schedules()
    {
        return $this->belongsToMany(GymSchedule::class, 'gym_exercises_loockup', 'gym_sessions_id', 'gym_schedules_id');
    }

    public function exercises(){
        return $this->hasManyThrough(GymExercise::class,
                                    GymExercisesLookup::class,
                                     'gym_sessions_id',
                                    'id',
                                     'id',
                                    'gym_exercises_id');
    }
}
