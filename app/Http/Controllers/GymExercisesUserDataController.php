<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseUserDataRequest;
use Illuminate\Http\Request;

class GymExercisesUserDataController extends Controller
{
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
    public function create(StoreExerciseUserDataRequest $request)
    {
        $request->validated($request->all());
        if(isset($exercises))
            return $this->success($exercises,'Esercizi recuperati con successo',200 );
        else
            return $this->error('','Impossibile recuperare gli esercizi', 500 );
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
    public function show(string $id)
    {
        //
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
