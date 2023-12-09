<?php

namespace App\Http\Controllers;

use App\Http\Requests\SelectExerciseDetails;
use App\Models\GymExercisesDetails;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GymExercisesDetailsController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(SelectExerciseDetails $request)
    {
        $request->validated($request->all());
        $request['user_id'] = Auth::id();
        $details = GymExercisesDetails::where('user_id', Auth::id())
                            ->where('schedule_id', $request['schedule_id'])
                            ->where('session_id',  $request['session_id'])
                            ->where('exercise_id', $request['exercise_id'])
                            ->first();
        if(isset($details))
            return $this->success($details,'Dettaglio Esercizi recuperati con successo',200 );
        else
            return $this->error('','Impossibile recuperare il dettaglio esercizi', 500 );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
