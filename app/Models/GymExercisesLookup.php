<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymExercisesLookup extends Model
{
   protected $table = "gym_exercises_lookup";

   protected $fillable = [
       'gym_exercises_id',
       'gym_sessions_id',
       'gym_schdeules_id',
   ];
}
