<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function Register(RegisterRequest $request){
        $user  = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $token = $user->createToken('token-name')->plainTextToken;


        return (new UserResource($user))
            ->additional([
                'Authorization' => [
                    'access_token' => 'Bearer '.$token,
                    ]]);
    }
}
