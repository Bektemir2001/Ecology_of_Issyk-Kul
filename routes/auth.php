<?php

use App\Http\Controllers\Auth\StaffAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/staff/login', [StaffAuthController::class, 'loginIndex'])->name('auth.staff.login.index');
Route::post('/staff/login', [StaffAuthController::class, 'login'])->name('auth.staff.login');
