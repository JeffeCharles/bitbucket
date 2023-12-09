<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponces;
use App\Http\Requests\StoreUser;

class AuthController extends Controller
{
    use HttpResponces;

    public function login(){
        return "This is my login Method";
    }

    public function register(StoreUser $request){

        $request->validated($request->all());
        $user = User::create([
            'name' => $request->name,
            'email'=>$request->email,
            'password' => Hash::make($request->password),  
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of' . $user->name)->plainTextToken
        ]);


        return response()->json('This is my register Method');
    }

    public function logout(){
        return response()->json('This is my logout Method');
    }
}

