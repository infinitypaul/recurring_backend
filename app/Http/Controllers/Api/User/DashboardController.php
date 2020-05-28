<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return new UserResource(request()->user());
    }
    public function Logout(){
        request()->user()->tokens()->delete();
    }
}
