<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    /**
     * @return \Illuminate\Http\JsonResponse
     * Se lutente riesce a loggarsi un nuovo token viene generato
     */
    public function login(LoginUserRequest $request){
        $request->validated($request->all());
        if(!Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return $this->error('',"Le credenziali di login non sono valide",401 );
    }
        $user = User::where('email', $request->email)->first();
        return $this->success([
            'user'=>$user,
            'token'=>$user->createToken('Api Token of '. $user->name)->plainTextToken
        ]);
    }


    public function register(StoreUserRequest $request){
        $request->validated($request->all());
        $user = User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ]);
        return $this->success([
            'user' =>$user,
            'token'=>$user->createToken('Api Token of '. $user->name)->plainTextToken
        ]);
    }


   public function logout(){
        return  response()->json("Metodo Logout raggiunto");
    }

}
