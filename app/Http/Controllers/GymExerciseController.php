<?php

namespace App\Http\Controllers;

use App\Models\GymExercise;
use Illuminate\Http\Request;
use App\Http\Utilities\Utilities;

class GymExerciseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //return  GymExercise::all()->toJson();
        $exercises = GymExercise::all();

        if(isset($exercises))
            return Utilities::jsonPositiveResponse('Esercizi recuperati con successo', $exercises);
        else
            return Utilities::jsonNegativeResponse('Impossibile recuperare gli esercizi');
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
        $test = ["test" => "my json object"];
        return $test->toJson();
    }

    /**
     * Display the specified resource.
     */
    public function show(GymExercise $gymExercises)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymExercise $gymExercises)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GymExercise $gymExercises)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymExercise $gymExercises)
    {
        //
    }
}
