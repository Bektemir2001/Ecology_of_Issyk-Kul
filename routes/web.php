<?php

use App\Http\Controllers\Admin\ElementController;
use App\Http\Controllers\Admin\MajorIonController;
use App\Http\Controllers\Admin\OrganicSubstanceController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [IndexController::class, 'index']);
Route::post('/index/post', [IndexController::class, 'postData'])->name('post');
Route::group(['prefix' => 'elements'], function (){
    Route::get('/get/all', [ElementController::class, 'getAll'])->name('elements.get.all');
});
Route::group(['prefix' => 'ions'], function (){
    Route::get('/get/all', [MajorIonController::class, 'getAll'])->name('ions.get.all');
});

Route::group(['prefix' => 'organic_substances'], function (){
    Route::get('/get/all', [OrganicSubstanceController::class, 'getAll'])->name('organic_substances.get.all');
});
