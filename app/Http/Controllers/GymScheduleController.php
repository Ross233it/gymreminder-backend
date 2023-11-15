<?php

namespace App\Http\Controllers;

use App\Models\GymSchedule;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GymScheduleController extends Controller{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $schedules = GymSchedule::where('user_id', $userId)->get();
        if(isset($schedules))
            return $this->success($schedules,'Le schede utente recueprate',200 );
        else
            return $this->error('','Impossibile recuperare le schede', 500 );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GymSchedule $gymSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymSchedule $gymSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GymSchedule $gymSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymSchedule $gymSchedule)
    {
        //
    }
}
