<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseRequest;
use App\Models\GymExercise;
use App\Models\GymExercisesLookup;
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

    public function indexAdmin(){
        $schedules = GymExercise::orderBy('created_at', 'DESC')->get();
        if (isset($schedules))
            return $this->success($schedules, 'Le schede utente recuperate', 200);
        else
            return $this->error('', 'Impossibile recuperare le schede', 500);
    }

    public function duplicate($exerciseId)
    {
        $exercise = GymExercise::find($exerciseId);
        $newExercise = GymExercise::create([
            'name'        => $exercise->name . rand(0, 9),
            'description' => $exercise->description,
            'ambito'      => $exercise->ambito
        ]);
        if($newExercise)
            return $this->success($newExercise, "Esercizio duplicato correttamente");
        else
            return $this->error('', "L'esercizio' non è stato duplicato", 500);
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
    public function store(StoreExerciseRequest $request, int $exerciseId = null)
    {
        $request->validated($request->all());

        if($exerciseId === null){
            $exercise = GymExercise::create([
                'name' =>$request->name,
                'description'=>$request->description,
                'ambito'=>$request->ambito
            ]);}
        else
            $exercise = GymExercise::where('id', $exerciseId)->update([
                'name' => $request->name,
                'description' => $request->description,
                'ambito' => $request->ambito,
            ]);
        if($exercise)
            return $this->success($exercise, "Esercizio creato/aggiornato correttamente");
        else
            return $this->error('', "Il nuovo esercizio non è stato creato/aggiornato", 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $exercise = GymExercise::with(['appMedia'])->find($id);
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
            return $this->error('', "Impossibile modificare esercizio", 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $exerciseId)
    {
        $toDelete = GymExercise::find($exerciseId);

        if($toDelete) {
            $deleted = $toDelete->delete();
            GymExercisesLookup::where('gym_exercises_id', $exerciseId)->delete();
            return $this->success($deleted, "Esercizio eliminato");
        }else
            return $this->error('', "Impossibile eliminare esercizio", 500);
    }

    public function getExerciseWithMedia(int $exerciseId){
        $exercise = GymExercise::with('appMedia')->where('id',$exerciseId)->get();
        if($exercise)
            return $this->success($exercise, "Esercizio recuperato");
        return $this->error('', "Impossibile recuperare esercizio", 500);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymExercise $gymExercises)
    {
        //
    }
}
