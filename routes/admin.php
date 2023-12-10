<?php

use App\Http\Controllers\Admin\ElementController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\LakeController;
use App\Http\Controllers\Admin\MajorIonController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function (){
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');

    Route::group(['prefix' => 'lake'], function (){
        Route::get('/', [LakeController::class, 'index'])->name('admin.lakes.index');
        Route::post('/', [LakeController::class, 'store'])->name('admin.lakes.store');
        Route::get('/create', [LakeController::class, 'create'])->name('admin.lakes.create');
        Route::get('/edit/{lake}', [LakeController::class, 'edit'])->name('admin.lakes.edit');
        Route::get('/show/{lake}', [LakeController::class, 'show'])->name('admin.lakes.show');
        Route::get('/delete/{lake}', [LakeController::class, 'delete'])->name('admin.lakes.delete');
    });
    Route::group(['prefix' => 'element'], function (){
        Route::get('/', [ElementController::class, 'index'])->name('admin.elements.index');
        Route::post('/', [ElementController::class, 'store'])->name('admin.elements.store');
        Route::get('/create', [ElementController::class, 'create'])->name('admin.elements.create');
        Route::get('/edit/{element}', [ElementController::class, 'edit'])->name('admin.elements.edit');
        Route::get('/show/{element}', [ElementController::class, 'show'])->name('admin.elements.show');
        Route::get('/delete/{element}', [ElementController::class, 'delete'])->name('admin.elements.delete');
    });

    Route::group(['prefix' => 'major_ion'], function (){
        Route::get('/', [MajorIonController::class, 'index'])->name('admin.major_ions.index');
        Route::post('/', [MajorIonController::class, 'store'])->name('admin.major_ions.store');
        Route::get('/create', [MajorIonController::class, 'create'])->name('admin.major_ions.create');
        Route::get('/edit/{major_ion}', [MajorIonController::class, 'edit'])->name('admin.major_ions.edit');
        Route::get('/show/{major_ion}', [MajorIonController::class, 'show'])->name('admin.major_ions.show');
        Route::get('/delete/{major_ion}', [MajorIonController::class, 'delete'])->name('admin.major_ions.delete');
    });
});
