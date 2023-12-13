<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponces;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;




class AuthController extends Controller
{
    use HttpResponces;

    public function login(LoginUserRequest $request){
        $request->validated();

    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return $this->error('', 'Credentials do not match', 401);
    }

    $user = User::where('email', $request->email)->first();

    return $this->success([
        'user' => $user,
        'token' => $user->createToken('Api Token of' . $user->name)->plainTextToken
    ]);
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
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have successfully logged out and your token has been deleted'
        ]);
    }
}

