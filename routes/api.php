<?php

use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Api\v1\ControlPointController;
use App\Http\Controllers\Api\v1\TransformationIndicatorController;
use App\Http\Controllers\Api\v1\TSIController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Auth\UserAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'user'], function (){
    Route::get('/', [UserController::class, 'test'])->middleware('auth:sanctum');
});


Route::post('/user/login', [UserAuthController::class, 'login']);
Route::post('/user/register', [UserAuthController::class, 'register']);

Route::get('/get/control_points', [ControlPointController::class, 'getAll']);
Route::get('/get/districts/{lake}', [DistrictController::class, 'getAll']);

Route::get('/transformation/indicator/{district}/{year}', [TransformationIndicatorController::class, 'getData']);

Route::get('/tsi/{district}/{year}', [TSIController::class, 'index']);
Route::get('/tli/{district}/{year}', [TSIController::class, 'index']);
