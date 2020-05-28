<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return ServiceResource::collection(Service::paginate(20));
    }

    public function service(Service $service){
        return new ServiceResource($service);
    }
}
