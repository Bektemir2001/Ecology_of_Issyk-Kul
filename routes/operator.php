<?php

use App\Http\Controllers\Operator\DataController;
use App\Http\Controllers\Operator\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('operator.index');
Route::group(['prefix' => 'data'], function (){
    Route::get('/', [DataController::class, 'index'])->name('operator.data.index');
    Route::get('/create', [DataController::class, 'create'])->name('operator.data.create');
    Route::post('/store', [DataController::class, 'store'])->name('operator.data.store');
});
