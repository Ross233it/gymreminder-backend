<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppMedia extends Model
{
    protected $table = "app_media";

    protected $fillable = [
        'name',
        'path',
        'exercise_id'
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

    public function exercises(){
        return $this->belongsTo(GymExercise::class, 'id', 'exercise_id');
    }

}
