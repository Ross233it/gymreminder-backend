<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymSession extends Model
{
    protected $table = "gym_sessions";

    protected $fillable = [
        'name',
        'description',
        'gym_schedules_id'
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

    public function gymSchedule()
    {
        return $this->belongsTo(GymSchedule::class,  'gym_schedules_id', 'id',);
    }
}
