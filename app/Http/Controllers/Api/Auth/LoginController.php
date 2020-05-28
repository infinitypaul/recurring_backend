<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('token-name')->plainTextToken;

            return (new UserResource($user))
                ->additional([
                    'meta' => [
                        'access_token' => $token,
                    ]]);
        }

        return response()->json([
            'message' => 'Something Is Wrong'
        ], 422);
    }


}
