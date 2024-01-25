<?php

use App\Http\Controllers\Auth\OperatorAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/operator/login', [OperatorAuthController::class, 'loginIndex'])->name('auth.staff.login.index');
Route::post('/operator/login', [OperatorAuthController::class, 'login'])->name('auth.staff.login');
