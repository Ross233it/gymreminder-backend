<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GymScheduleLookup extends Model
{
    use SoftDeletes;
    protected $table = "gym_schedules_lookup";

}
