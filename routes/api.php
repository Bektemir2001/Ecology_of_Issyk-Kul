<?php

use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Api\v1\CoastalBufferZoneController;
use App\Http\Controllers\Api\v1\ControlPointController;
use App\Http\Controllers\Api\v1\ReportController;
use App\Http\Controllers\Api\v1\TLIController;
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
Route::post('/get/control_points/withPdk', [ControlPointController::class, 'getWithPDK']);
Route::get('/get/districts/{lake}', [DistrictController::class, 'getAll']);

Route::get('/transformation/indicator/{year}/{district}', [TransformationIndicatorController::class, 'getData']);

Route::get('/tsi/{year}/{district}', [TSIController::class, 'index']);
Route::get('/tli/{year}/{district}', [TLIController::class, 'index']);

Route::post('/calculate/horizontal/buffer/zone', [CoastalBufferZoneController::class, 'horizontalCalculation']);

Route::group(['prefix' => 'report'], function (){
    Route::get('/get/fields', [ReportController::class, 'getFields']);
    Route::post('/get/report', [ReportController::class, 'getData']);
    Route::post('/get/point/report', [ReportController::class, 'getDataForPoint']);
});
