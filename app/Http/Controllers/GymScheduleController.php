<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Models\GymExercisesLookup;
use App\Models\GymSchedule;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Models\GymScheduleLookup;
use Illuminate\Support\Facades\Auth;
use http\Client\Request;
use function Symfony\Component\String\s;


class GymScheduleController extends Controller{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(){
        if (Auth::check()) {
                $schedules = User::with('gymSchedules')
                    ->with('gymSchedules.sessions')
                    ->where('id', Auth::id())
                    ->get();
                $schedules = ($schedules[0]['gymSchedules']);
        }
        if (isset($schedules))
            return $this->success($schedules, 'Le schede utente recuperate', 200);
        else
            return $this->error('', 'Impossibile recuperare le schede', 500);
        }

        public function indexAdmin(){
            $schedules = GymSchedule::with('sessions')
                        ->orderBy('created_at', 'DESC')
                        ->get();
            if (isset($schedules))
                return $this->success($schedules, 'Le schede utente recuperate', 200);
            else
                return $this->error('', 'Impossibile recuperare le schede', 500);
        }

        public function duplicate($scheduleId){
            $schedule = GymSchedule::with("gymExercisesLookup")->find($scheduleId);

            $newSchedule = GymSchedule::create([
                'name' =>$schedule->name.rand(0,9),
                'description'=>$schedule->description,
            ]);
            if($newSchedule)
                $newId = $newSchedule->id;
            $data = $schedule->gymExercisesLookup;
            $modifiedData = $data->map(function ($item) use ($newId) {
                $item['id'] = '';
                $item['gym_schedules_id'] = $newId;
                return $item;
            });
            $scheduleData = GymExercisesLookup::insert($modifiedData->toArray());
            if($scheduleData)
                return $this->success($newSchedule, "Scheda ginnica duplicata correttamente");
            else
                return $this->error('', "La scheda non è stata duplicata", 500);

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
//    public function store(StoreScheduleRequest $request, $scheduleId = null)
    public function store(StoreScheduleRequest $request, $scheduleId = null)
    {
        $request->validated($request->all());
        if($scheduleId === null)
            $schedule = GymSchedule::create([
                'name' =>$request->name,
                'description'=>$request->description,
            ]);
        else
            $schedule = GymSchedule::where('id', $scheduleId)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        if($schedule)
            return $this->success($schedule, "Scheda ginnica creata correttamente");
        else
            return $this->error('', "La scheda non è stata creata", 500);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $userId = Auth::id();
        if(Auth::check()){
            $schedules = GymSchedule::where('user_id', $userId)->with('sessions')->orderBy('created_at', 'desc')->get();
            if(isset($schedules))
                return $this->success($schedules,'Le schede utente recueprate',200 );
            else
                return $this->error('','Impossibile recuperare le schede', 500 );
        }
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
//        GymSchedule::
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $scheduleId)
    {
        $toDelete = GymSchedule::find($scheduleId);

        if($toDelete) {
            $deleted = $toDelete->delete();
            return $this->success($deleted, "Scheda ginnica eliminata");
        }else
            return $this->error('', "La scheda non è stata eliminata", 500);
    }

    public function scheduleWithSessions(int $scheduleId){
        if(Auth::check() && $this->checkScheduleId($scheduleId)){
            $schedule = GymSchedule::where('id', $scheduleId)
                ->with('sessions')->orderBy('created_at', 'desc')->first();
            if(isset($schedule))
                return $this->success($schedule,'Scheda utente recueprata',200 );
            else
                return $this->error('','Impossibile recuperare le scheda', 500 );
        }
    }

    /**
     * Verifica se una scheda allenamento è associata ad un
     * utente.
     * @return boolean
     */
    private function checkScheduleId(int $scheduleId){
        $scheduleIdList = GymScheduleLookup::select('gym_schedules_id')
                            ->where('user_id', Auth::id())->get();
        $scheduleIdList = $scheduleIdList->pluck('gym_schedules_id')->toArray();
        return in_array($scheduleId, $scheduleIdList);
    }
}
