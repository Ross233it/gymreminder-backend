<?php

namespace App\Http\Controllers;

use App\Models\GymSchedule;
use Illuminate\Http\Request;

class GymScheduleController extends Controller
{
    public function test(Request $request){
        $data = [
          'dato1' => "contenuto dato 1",
          'dato2' => "contenuto dato 2",
          'dato3' => "contenuto dato 3",
          'dato4' => "contenuto dato 4",
          'dato7' => "contenuto dato 7"
        ];

       //dd($request);
        return response()->json(['message'=> 'funzione raggiunta', 'data'=> $data]);

    }
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
    public function show(GymSchedule $gymSchedule)
    {
        //
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
    public function update(Request $request, GymSchedule $gymSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymSchedule $gymSchedule)
    {
        //
    }
}
