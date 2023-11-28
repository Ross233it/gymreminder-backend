<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public routes
Route::post('/login', [\App\Http\Controllers\AuthController::class,    'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

//Protected routes
//definiamo un grouppo di rotte protette dal middleware auth:sanctum
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::resource('/tasks', \App\Http\Controllers\TasksController::class);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class,   'logout']);

    Route::resource('/exercises', \App\Http\Controllers\GymExerciseController::class );
    Route::post('/exercises/{id}', [\App\Http\Controllers\GymExerciseController::class, 'update']);
    Route::get ('/exercises/{id}', [\App\Http\Controllers\GymExerciseController::class, 'show']);
    Route::get('/exercises/{id}/user-data', [\App\Http\Controllers\GymExercisesUserDataController::class, 'show']);
    Route::post('/exercises/{id}/user-data', [\App\Http\Controllers\GymExercisesUserDataController::class, 'create']);

    Route::resource('/schedules', \App\Http\Controllers\GymScheduleController::class );

    Route::post('/schedules/{id}', [\App\Http\Controllers\GymScheduleController::class, 'update']);
    Route::resource('/sessions', \App\Http\Controllers\GymSessionsController::class );


    Route::get('/schedules/{schedule_id}/sessions',[\App\Http\Controllers\GymScheduleController::class, 'scheduleWithSessions']);
    Route::get('/schedules/{schedule_id}/sessions/{session_id}/exercises', [\App\Http\Controllers\GymSessionsController::class, 'sessionWithExercises']);



});

