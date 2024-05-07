<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\OperatorAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/operator/login', [OperatorAuthController::class, 'loginIndex'])->name('auth.operator.login.index');
Route::post('/operator/login', [OperatorAuthController::class, 'login'])->name('auth.operator.login');


Route::get('/admin/login', [AdminAuthController::class, 'loginIndex'])->name('auth.admin.login.index');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('auth.admin.login');

Route::post('/logout', function (){
    Auth::logout();
    return redirect()->route('auth.operator.login');
})->name('logout');

Route::get('/unauthorized', function (){
    return response(['message' => 'unauthorized'])->setStatusCode(401);
})->name('unauthorized');
