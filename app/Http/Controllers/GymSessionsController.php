<?php

namespace App\Http\Controllers;

use App\Models\GymExercise;
use App\Models\GymExercisesLookup;
use App\Models\GymSchedule;
use App\Models\GymScheduleLookup;
use App\Models\GymSession;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSessionRequest;
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
        $sessions = GymSession::orderBy('created_at', 'DESC')->get();
        if (isset($sessions))
            return $this->success($sessions, 'Sessioni recuperate', 200);
        else
            return $this->error('', 'Impossibile recuperare le sessioni', 500);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSessionRequest $request, $scheduleId = null)
    {
        $request->validated($request->all());
        if($scheduleId === null)
            $session = GymSession::create([
                'name' =>$request->name,
                'description'=>$request->description,
            ]);
        else
            $session = GymSession::where('id', $scheduleId)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        if($session)
            return $this->success($session, "Sessione creata correttamente");
        else
            return $this->error('', "La sessione non è stata creata", 500);
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

    public function duplicate($sessionId){
        $session = GymSession::with("gymExercisesLookup")->find($sessionId);
        $newSession = GymSession::create([
            'name' =>$session->name.rand(0,9),
            'description'=>$session->description,
        ]);
        if($newSession)
            $newId = $newSession->id;
        $data = $session->gymExercisesLookup;
        $modifiedData = $data->map(function ($item) use ($newId) {
            $item['id'] = '';
            $item['gym_sessions_id'] = $newId;
            return $item;
        });
        $sessionData = GymExercisesLookup::insert($modifiedData->toArray());
        if($sessionData)
            return $this->success($newSession, "Scheda ginnica duplicata correttamente");
        else
            return $this->error('', "La scheda non è stata duplicata", 500);
    }

    /**
     * @param int $sessionId
     * @return \Illuminate\Http\JsonResponse
     * Delete a specific Gym Session and related Exercises Lookup - softdeletes
     */
    public function delete(int $sessionId)
    {
        $toDelete = GymSession::find($sessionId);

        if($toDelete) {
            $deleted = $toDelete->delete();
            GymExercisesLookup::where('gym_sessions_id', $sessionId)->delete();
            return $this->success($deleted, "Sessione di allenamento eliminata");
        }else
            return $this->error('', "La sessione non è stata eliminata", 500);
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
            $session = GymSchedule::where('id', $schedule_id)->first();
            $session = GymSession::where('id', $session_id)->first();
            if($exercises)
               return $this->success(
                   ['schedule'=>$session, 'session'=>$session, 'exercises'=>$exercises],
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
