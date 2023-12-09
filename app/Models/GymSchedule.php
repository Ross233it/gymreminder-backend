<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public function sessions()
    {
        return $this->belongsToMany(GymSession::class, 'gym_exercises_lookup', 'gym_schedules_id', 'gym_sessions_id')
            ->distinct();
    }

    public function users()
    {
        $userId = Auth::id();
        return $this->belongsToMany(User::class, 'gym_schedules_lookup', 'gym_schedules_id', 'user_id')->where('user_id', $userId);
    }


}
