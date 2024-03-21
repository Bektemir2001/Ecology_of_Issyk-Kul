<?php

use App\Http\Controllers\Auth\OperatorAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/operator/login', [OperatorAuthController::class, 'loginIndex'])->name('auth.operator.login.index');
Route::post('/operator/login', [OperatorAuthController::class, 'login'])->name('auth.operator.login');


Route::get('/admin/login', [OperatorAuthController::class, 'loginIndex'])->name('auth.admin.login.index');
Route::post('/admin/login', [OperatorAuthController::class, 'login'])->name('auth.admin.login');


Route::get('/unauthorized', function (){
    return response(['message' => 'unauthorized'])->setStatusCode(401);
})->name('unauthorized');
