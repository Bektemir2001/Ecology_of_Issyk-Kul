<?php

use App\Http\Controllers\Auth\OperatorAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/operator/login', [OperatorAuthController::class, 'loginIndex'])->name('auth.operator.login.index');
Route::post('/operator/login', [OperatorAuthController::class, 'login'])->name('auth.operator.login');
