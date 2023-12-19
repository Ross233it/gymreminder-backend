<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GymExercisesLookup extends Model
{
   use SoftDeletes;

   protected $table = "gym_exercises_lookup";

   protected $fillable = [
       'gym_exercises_id',
       'gym_sessions_id',
       'gym_schdeules_id',
   ];
}
