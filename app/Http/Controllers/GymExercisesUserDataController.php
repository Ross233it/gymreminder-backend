<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseUserDataRequest;
use App\Models\GymExercisesUserData;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GymExercisesUserDataController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       if(Auth::check()){
           $userData = GymExercisesUserData::where('user_id', Auth::id())->get();
           if($userData)
               return $this->success($userData, "Dati esercizi recuperati correttamente",200);
           else
               return $this->error('', "La scheda non è stata creata", 500);
       }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreExerciseUserDataRequest $request)
    {
        $request->validated($request->all());
        $request['date'] = Carbon::now();
        $request['user_id'] = Auth::id();

        if($request->id == null)
            $exercisesUserData = GymExercisesUserData::create($request->all());
        else{
           $exercisesUserData = GymExercisesUserData::where('id', $request->id)->update([
               'series' => $request->series,
               'repetitions' => $request->repetitions,
               'weight' => $request->weight,
           ]);}
        if(isset($exercisesUserData))
            return $this->success($exercisesUserData,'Esercizi inseriti con successo',200 );
        else
            return $this->error('','Impossibile recuperare gli esercizi', 500 );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Auth::check()){
            $userData = GymExercisesUserData::where('user_id', Auth::id())
                        ->where('exercise_id', $id)
                        ->limit(10)
                        ->orderBy('date', 'DESC')
                        ->get();
            if($userData)
                return $this->success($userData, "Dati esercizi recuperati correttamente",200);
            else
                return $this->error('', "Si è verificato un errore - dati non recuperati", 500);
        }
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
        if(Auth::check()){
            $userId = Auth::id();
            $currentItem = GymExercisesUserData::where('id', $id)->first();
            if($currentItem->user_id == $userId)
                $deleted = $currentItem->delete();
            if(isset($deleted))
                return $this->success($id, "Dati esercizi recuperati correttamente",200);
        }
        return $this->error('', "Si è verificato un errore - dati non cancellati", 500);
    }
}
