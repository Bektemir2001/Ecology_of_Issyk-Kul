<?php

use App\Http\Controllers\Operator\DataController;
use App\Http\Controllers\Operator\EarthTransformationIndicatorController;
use App\Http\Controllers\Operator\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('operator.index');
Route::group(['prefix' => 'data'], function (){
    Route::get('/', [DataController::class, 'index'])->name('operator.data.index');
    Route::get('/create', [DataController::class, 'create'])->name('operator.data.create');
    Route::post('/store', [DataController::class, 'store'])->name('operator.data.store');
});

Route::group(['prefix' => 'earth_transformation_indicators'], function (){
    Route::get('/', [EarthTransformationIndicatorController::class, 'index'])->name('operator.earth.transformation.indicators.index');
    Route::post('/', [EarthTransformationIndicatorController::class, 'store'])->name('operator.earth.transformation.indicators.store');
    Route::get('/create', [EarthTransformationIndicatorController::class, 'create'])->name('operator.earth.transformation.indicators.create');
    Route::get('/edit/{earth_transformation_indicator}', [EarthTransformationIndicatorController::class, 'edit'])->name('operator.earth.transformation.indicators.edit');
    Route::post('/update/{earth_transformation_indicator}', [EarthTransformationIndicatorController::class, 'update'])->name('operator.earth.transformation.indicators.update');
    Route::get('/show/{earth_transformation_indicator}', [EarthTransformationIndicatorController::class, 'show'])->name('operator.earth.transformation.indicators.show');
    Route::get('/delete/{earth_transformation_indicator}', [EarthTransformationIndicatorController::class, 'delete'])->name('operator.earth.transformation.indicators.delete');
});
