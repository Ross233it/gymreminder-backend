<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymExercisesUserData extends Model
{
    protected $table = "gym_exercises_user_data";

    protected $fillable = [
        'user_id',
        'session_id',
        'data',
        'series',
        'repetitions',
        'weight'
        ];

    protected $hidden = [
      'user_id',
      'session_id',
      'created_at',
      'updated_at'
    ];

}
