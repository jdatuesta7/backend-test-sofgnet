<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\RouteController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\VehicleController;
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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function($router){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => 'api'], function(){
    Route::get('logout', [AuthController::class, 'logout']);

    Route::post('drivers', [DriverController::class, 'store']);
    Route::get('drivers', [DriverController::class, 'index']);
    Route::get('drivers/{driver}', [DriverController::class, 'show']);
    Route::put('drivers/{driver}', [DriverController::class, 'update']);
    Route::delete('drivers/{driver}', [DriverController::class, 'delete']);

    Route::post('vehicles', [VehicleController::class, 'store']);
    Route::get('vehicles', [VehicleController::class, 'index']);
    Route::get('vehicles/{vehicle}', [VehicleController::class, 'show']);
    Route::put('vehicles/{vehicle}', [VehicleController::class, 'update']);
    Route::delete('vehicles/{vehicle}', [VehicleController::class, 'delete']);

    Route::post('routes', [RouteController::class, 'store']);
    Route::get('routes', [RouteController::class, 'index']);
    Route::get('routes/{route}', [RouteController::class, 'show']);
    Route::put('routes/{route}', [RouteController::class, 'update']);
    Route::delete('routes/{route}', [RouteController::class, 'delete']);

    Route::post('schedules', [ScheduleController::class, 'store']);
    Route::get('schedules/{route}', [ScheduleController::class, 'showRouteSchedules']);
});