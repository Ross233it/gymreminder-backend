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
    public function appMedia(){
        return $this->hasMany(AppMedia::class, 'exercise_id', 'id');
    }

    public function gymSchedules(){
        return $this->belongsToMany(GymSchedules::class, 'gym_exercises_lookup', 'gym_schedules_id', 'gym_exercises_id');
    }

//    public function appMedia(){
//        return $this->hasMany(AppMedia::class, 'exercise_id');
//    }
}
