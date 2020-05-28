<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::group(['namespace' => 'Api\Auth'], function (){
        Route::post('login', 'LoginController@Login');
        Route::post('register', 'RegisterController@Register');

    });

    Route::group(['namespace' => 'Api\Products'], function (){
        Route::get('services', 'ServiceController@index');
        Route::get('services/{service}', 'ServiceController@service');
    });

    Route::group(['prefix' => 'dashboard', 'namespace' => 'Api\User', 'middleware' => ['auth:sanctum']], function (){
        Route::get('/', 'DashboardController@index');
        Route::post('transaction/{service}', 'TransactionController@create');
        Route::post('transaction/verify/{transaction:reference}', 'TransactionController@verify');
        Route::post('transaction/recurring/{transaction:reference}', 'RecurringController@createPlan');
        Route::post('logout', 'DashboardController@logout');
    });




//    Route::middleware('auth:sanctum')->get('/dashboard', function (Request $request) {
//        return $request->user();
//    });
});




