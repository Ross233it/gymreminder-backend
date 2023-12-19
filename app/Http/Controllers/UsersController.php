<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Http\Utilities\CrudUtilities;

class UsersController extends Controller
{
    use HttpResponses;
    protected $CrudUtilities;

    public function __construct(CrudUtilities $CrudUtilities){
        $this->CrudUtilities = $CrudUtilities;
    }

//    public function index(){
//        $users = User::orderBy('name')->get();
//        if (isset($users))
//            return $this->success($users, 'Utenti recuperate', 200);
//        else
//            return $this->error('', 'Impossibile recuperare gli utenti', 500);
//    }
    public function index(){
       return $this->CrudUtilities->indexRecord(new User, 'name', 'ASC');
    }

    public function store(EditUserRequest $request, $userId = null){
        if($userId != null){
            $request->validated($request->all());
            $data = ['name'  => $request->name,
                     'email' => $request->email];
            return $this->CrudUtilities->editRecord(new User, $userId, $data);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $userId){
        return $this->CrudUtilities->deleteRecord(new User, $userId);
    }

    public function getUserSchedules(int $userId){
        $user = User::where('id', $userId)->with('gymSchedules')->first();
        if (isset($user))
            return $this->success($user, 'Utenti recuperate', 200);
        else
            return $this->error('', 'Impossibile recuperare gli utenti', 500);
    }
}
