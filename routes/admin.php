<?php

use App\Http\Controllers\Admin\ControlPointController;
use App\Http\Controllers\Admin\ElementController;
use App\Http\Controllers\Admin\ElementTypeController;
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

    Route::group(['prefix' => 'element_type'], function (){
        Route::get('/', [ElementTypeController::class, 'index'])->name('admin.element_types.index');
        Route::post('/', [ElementTypeController::class, 'store'])->name('admin.element_types.store');
        Route::get('/create', [ElementTypeController::class, 'create'])->name('admin.element_types.create');
        Route::get('/edit/{element_type}', [ElementTypeController::class, 'edit'])->name('admin.element_types.edit');
        Route::get('/show/{element_type}', [ElementTypeController::class, 'show'])->name('admin.element_types.show');
        Route::get('/delete/{element_type}', [ElementTypeController::class, 'delete'])->name('admin.element_types.delete');
    });
    Route::group(['prefix' => 'control_point'], function (){
        Route::get('/', [ControlPointController::class, 'index'])->name('admin.control_points.index');
        Route::post('/', [ControlPointController::class, 'store'])->name('admin.control_points.store');
        Route::get('/create', [ControlPointController::class, 'create'])->name('admin.control_points.create');
        Route::get('/edit/{control_point}', [ControlPointController::class, 'edit'])->name('admin.control_points.edit');
        Route::get('/show/{control_point}', [ControlPointController::class, 'show'])->name('admin.control_points.show');
        Route::get('/delete/{control_point}', [ControlPointController::class, 'delete'])->name('admin.control_points.delete');
    });
});
