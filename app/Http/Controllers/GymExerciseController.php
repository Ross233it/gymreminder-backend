<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseRequest;
use App\Models\GymExercise;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
class GymExerciseController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing all exercises
     */
    public function index()
    {
        $exercises = GymExercise::all();
        if(isset($exercises))
           return $this->success($exercises,'Esercizi recuperati con successo',200 );
        else
           return $this->error('','Impossibile recuperare gli esercizi', 500 );
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
    public function store(StoreExerciseRequest $request)
    {
        $request->validated($request->all());
        $exercise = GymExercise::create([
            'name' =>$request->name,
            'description'=>$request->description,
        ]);
        if($exercise)
            return $this->success($exercise, "Esercizio creato correttamente");
        else
            return $this->error('', "Il nuovo esercizio non è stato creato", 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $exercise = GymExercise::with('appMedia')->find($id);
        if($exercise)
            return $this->success($exercise, "Esercizio recuperato correttamente");
        else
            return $this->error('', "Impossibile trovare l'esercizio", 500);
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
    public function update(StoreExerciseRequest $request, $id){
        $request->validated($request->all());

        $exercise = GymExercise::where('id', $id)->update([
            'name' =>$request->name,
            'description'=>$request->description,
        ]);

        if($exercise)
            return $this->success($exercise, "Esercizio modificato correttamente");
        else
            return $this->error('', "L' esercizio non è stato modificato", 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymExercise $gymExercises)
    {
        //
    }
}
