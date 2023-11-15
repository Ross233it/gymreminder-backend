<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
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
    public function store(StoreScheduleRequest $request)
    {
        $userId = Auth::id();
        $request->validated($request->all());
        $schedule = GymSchedule::create([
                'name' =>$request->name,
                'description'=>$request->description,
                'user_id'=>$userId
        ]);

        if($schedule)
            return $this->success($schedule, "Scheda ginnica creata correttamente");
        else
            return $this->error('', "La scheda non è stata creata", 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $schedule = GymSchedule::where('user_id', Auth::id())
            ->where('id', $id)
            ->get();

        if($schedule)
            return $this->success($schedule, "Scheda recuperata correttamente");
        else
            return $this->error('', "Scheda inesistente o di altro utente", 500);//
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
    public function update(StoreScheduleRequest $request, int $id)
    {
        $request->validated($request->all());
        $schedule = GymSchedule::where('user_id', Auth::id())
            ->where('id', $id)
            ->get();
        if(isset($schedule))
        $edited = GymSchedule::where('id', $id)->update([
            'name' =>$request->name,
            'description'=>$request->description,]);
        if($edited)
            return $this->success($edited, "Scheda ginnica modificata correttamente");
        else
            return $this->error('', "La scheda non è stata modificata", 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymSchedule $gymSchedule)
    {
        //
    }
}
