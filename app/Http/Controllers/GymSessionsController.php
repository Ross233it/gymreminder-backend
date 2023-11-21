<?php

namespace App\Http\Controllers;

use App\Models\GymSchedule;
use App\Models\GymSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;

class GymSessionsController extends Controller
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
    public function show(string $id)
    {

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

    /**
     * @param int $sessionId
     * @return \Illuminate\Http\JsonResponse|void
     * Verifica la sessione e restituisce gli esercizi ad essa collegati
     */
    public function sessionWithExercises(int $sessionId){
        if(Auth::check()){
            if($this->checkSession($sessionId))
                $exercisesPerSession = GymSession::where('id',$sessionId)->with('exercises')->get();

            if($exercisesPerSession)
               return $this->success($exercisesPerSession, "Sessioni recuperate correttamente");
            else
                return $this->error('', "La scheda non è stata creata", 500);
        }
    }

    /**
     * @param int $sessionId
     * @return mixed
     * Verifica se la sessione richiesta appartiene a quelle dell'utente
     */
    public function checkSession(int $sessionId){
        $userId = Auth::id();
        $userSchedules = GymSchedule::select('id')
            ->where('user_id', $userId)->get()->pluck('id');

        $sessionSchedule = GymSession::select('gym_schedules_id')
            ->where('gym_schedules_id', $sessionId)->first();

        if(isset($sessionSchedule))
             return ($userSchedules->contains($sessionSchedule->gym_schedules_id));
        return $this->error('', "Non è possibile recuperare la scheda", 500);
    }
}
