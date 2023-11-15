<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymSchedule extends Model
{
    protected $table = "gym_schedules";

    protected $fillable = [
        'name',
        'gym_session',
        'description',
        'user_id'
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

    public function gymExercises()
    {
        return $this->belongsToMany(GymExercise::class, 'gym_exercises_lookup', 'gym_exercises_id', 'gym_schedules_id');
    }
}
