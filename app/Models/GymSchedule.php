<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class GymSchedule extends Model
{
    use SoftDeletes;

    protected $table = "gym_schedules";

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    protected $hidden = [
        'deleted_at',
        'user_id',
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

    public function gymExercisesLookup(){
        return $this->hasMany(GymExercisesLookup::class, 'gym_schedules_id', 'id');

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
