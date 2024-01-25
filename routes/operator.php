<?php

use App\Http\Controllers\Operator\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('staff.index');
