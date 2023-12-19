<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GymScheduleController;
use App\Http\Controllers\GymExercisesUserDataController;
use App\Http\Controllers\GymExerciseController;

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
Route::get('/test/{id}', [\App\Http\Controllers\AppMediaController::class, 'test'])
    ->middleware('test_middleware')
    ->name('test');
//Admin routes
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::get('/admin/users',[\App\Http\Controllers\UsersController::class, 'index']);
    Route::get('/admin/users/{userId}/schedules',[\App\Http\Controllers\UsersController::class, 'getUserSchedules'])->name('getUserSchedules');
    Route::post('/admin/users/{userId}',[\App\Http\Controllers\UsersController::class, 'store']);
    Route::delete('/admin/users/{userId}',[\App\Http\Controllers\UsersController::class, 'delete']);


    Route::get('/admin/schedules',[\App\Http\Controllers\GymScheduleController::class, 'indexAdmin']);
    Route::delete('/admin/schedules/{scheduleId}',[GymScheduleController::class, 'delete']);
    Route::post('/admin/schedules/{scheduleId}/duplicate',[GymScheduleController::class, 'duplicate']);
    Route::post('/admin/schedules',[GymScheduleController::class, 'store']);
    Route::post('/admin/schedules/{scheduleId}',[GymScheduleController::class, 'store']);
});

//User routes
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::resource('/tasks', \App\Http\Controllers\TasksController::class);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class,   'logout']);

    Route::resource('/exercises', GymExerciseController::class );
    Route::post('/exercises/{id}', [GymExerciseController::class, 'update']);
    Route::get ('/exercises/{id}', [GymExerciseController::class, 'show']);
    Route::get('/exercises/{id}/user-data',  [GymExercisesUserDataController::class, 'show']);
    Route::post('/exercises/{id}/user-data', [GymExercisesUserDataController::class, 'create']);
    Route::delete('/user-data/{id}',         [GymExercisesUserDataController::class, 'destroy']);

    Route::get('/schedules', [GymScheduleController::class, 'index']);

    Route::get('/schedules/{id}', [GymScheduleController::class, 'update']);
    Route::resource('/sessions', \App\Http\Controllers\GymSessionsController::class );


    Route::get('/schedules/{schedule_id}/sessions',[\App\Http\Controllers\GymScheduleController::class, 'scheduleWithSessions']);
    Route::get('/schedules/{schedule_id}/sessions/{session_id}/exercises', [\App\Http\Controllers\GymSessionsController::class, 'sessionWithExercises']);
    Route::get('/schedules/{schedule_id}/sessions/{session_id}/exercises', [\App\Http\Controllers\GymSessionsController::class, 'sessionWithExercises']);

    Route::post('/exercise-details', [\App\Http\Controllers\GymExercisesDetailsController::class, 'show']);

});

