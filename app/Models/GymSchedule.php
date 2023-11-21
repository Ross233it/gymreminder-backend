<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymSchedule extends Model
{
    protected $table = "gym_schedules";

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    protected $hidden = [
        'deleted_at',
        'user_id'
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

    /**
     * Ritorna tutte le sessioni abbinate ad una scheda
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions(){
        return $this->hasMany(GymSession::class, 'gym_schedules_id');
    }

}
