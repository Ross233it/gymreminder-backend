<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GymExercise;

class GymExercisesDetails extends Model
{
        protected $table = 'gym_exercises_details';

        protected $fillable = [
                "user_id",
                "schedule_id",
                "session_id",
                "exercise_id",
                "suggested_series",
                "suggested_repetitions",
                "suggested_weight"];

        protected $hidden =[
                'id',
                "user_id",
                "schedule_id",
                "session_id",
                "exercise_id",
                "created_at",
                "updated_at"
        ];

        /************************************
         *                                  *
         *            Relations             *
         *                                  *
         ************************************/

         /**
         * Retrieve the parent exercise"
         */
        public function exercise(){
            return $this->belongsTo(GymExercise::class, 'exercise_id', 'id');
        }
}
