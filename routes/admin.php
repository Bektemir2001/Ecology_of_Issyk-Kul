<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\LakeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function (){
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');

    Route::group(['prefix' => 'lake'], function (){
        Route::get('/', [LakeController::class, 'index']);
    });
});
