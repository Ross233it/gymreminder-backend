<?php

namespace App\Http\Controllers;

use App\Models\GymExercise;
use App\Models\GymExercisesLookup;
use App\Models\GymSchedule;
use App\Models\GymScheduleLookup;
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
    public function sessionWithExercises(int $schedule_id, int $session_id){
        if(Auth::check() && $this->checkSessionId($schedule_id, $session_id)){;
            $exercisesIds = GymExercisesLookup::where('gym_schedules_id', $schedule_id)
                                ->where('gym_sessions_id', $session_id)
                                ->get()->pluck('gym_exercises_id');
            $exercises = GymExercise::whereIn('id', $exercisesIds)->get();
            $schedule = GymSchedule::where('id', $schedule_id)->first();
            $session = GymSession::where('id', $session_id)->first();
            if($exercises)
               return $this->success(
                   ['schedule'=>$schedule, 'session'=>$session, 'exercises'=>$exercises],
                   "Sessioni recuperate correttamente");
            else
                return $this->error('', "La scheda non è stata creata", 500);
        }
    }

    /**
     * @param int $sessionId
     * @return mixed
     * Verifica se la sessione richiesta appartiene a quelle dell'utente
     */
     private function checkSessionId(int $schedule_id, int $session_id){
        $userSchedules = GymScheduleLookup::select('gym_schedules_id')
            ->where('user_id',Auth::id())
            ->where('gym_schedules_id', $schedule_id)->first();

        $sessionSchedule = GymExercisesLookup::select('id')
            ->where('gym_schedules_id', $schedule_id)
            ->where('gym_sessions_id', $session_id)->first();

        if(isset($userSchedules) && isset($sessionSchedule))
            return true;
        return false;
    }
}
