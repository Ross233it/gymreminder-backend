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

    public function index(){
        $users = User::orderBy('name')->get();
        if (isset($users))
            return $this->success($users, 'Utenti recuperate', 200);
        else
            return $this->error('', 'Impossibile recuperare gli utenti', 500);
    }

//    public function store(EditUserRequest $request, $userId = null){
//        if($userId != null){
//            $request->validated($request->all());
//            $user = User::where('id', $userId)->update([
//                'name' => $request->name,
//                'email' => $request->email,
//            ]);
//        }
//        if (isset($user))
//            return $this->success($user, 'Utente modificato', 200);
//        else
//            return $this->error('', 'Impossibile modificare utente', 500);
//    }
//    public function store(EditUserRequest $request, $userId = null){
//        if($userId != null){
//            $request->validated($request->all());
//            $user = User::where('id', $userId)->update([
//                'name' => $request->name,
//                'email' => $request->email,
//            ]);
//        }
//        if (isset($user))
//            return $this->success($user, 'Utente modificato', 200);
//        else
//            return $this->error('', 'Impossibile modificare utente', 500);
//    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $userId){
        $model = new User;
        $this->CrudUtilities->deleteRecord($model, $userId);
    }
}
