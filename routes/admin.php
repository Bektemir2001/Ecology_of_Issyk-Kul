<?php

use App\Http\Controllers\Admin\ControlPointController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\ElementController;
use App\Http\Controllers\Admin\ElementTypeController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\LakeController;
use App\Http\Controllers\Admin\MajorIonController;
use App\Http\Controllers\Admin\OrganicSubstanceController;
use App\Http\Controllers\Admin\UserController;
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
    Route::group(['prefix' => 'organic_substances'], function (){
        Route::get('/', [OrganicSubstanceController::class, 'index'])->name('admin.organic_substances.index');
        Route::post('/', [OrganicSubstanceController::class, 'store'])->name('admin.organic_substances.store');
        Route::get('/create', [OrganicSubstanceController::class, 'create'])->name('admin.organic_substances.create');
        Route::get('/edit/{organic_substances}', [OrganicSubstanceController::class, 'edit'])->name('admin.organic_substances.edit');
        Route::get('/show/{organic_substances}', [OrganicSubstanceController::class, 'show'])->name('admin.organic_substances.show');
        Route::get('/delete/{organic_substances}', [OrganicSubstanceController::class, 'delete'])->name('admin.organic_substances.delete');
    });

    Route::group(['prefix' => 'element_type'], function (){
        Route::get('/', [ElementTypeController::class, 'index'])->name('admin.element_types.index');
        Route::post('/', [ElementTypeController::class, 'store'])->name('admin.element_types.store');
        Route::get('/create', [ElementTypeController::class, 'create'])->name('admin.element_types.create');
        Route::get('/edit/{element_type}', [ElementTypeController::class, 'edit'])->name('admin.element_types.edit');
        Route::get('/show/{element_type}', [ElementTypeController::class, 'show'])->name('admin.element_types.show');
        Route::get('/delete/{element_type}', [ElementTypeController::class, 'delete'])->name('admin.element_types.delete');
    });
    Route::group(['prefix' => 'district'], function (){
        Route::get('/', [DistrictController::class, 'index'])->name('admin.districts.index');
        Route::post('/', [DistrictController::class, 'store'])->name('admin.districts.store');
        Route::get('/create', [DistrictController::class, 'create'])->name('admin.districts.create');
        Route::get('/edit/{district}', [DistrictController::class, 'edit'])->name('admin.districts.edit');
        Route::post('/update/{district}', [DistrictController::class, 'update'])->name('admin.districts.update');
        Route::get('/show/{district}', [DistrictController::class, 'show'])->name('admin.districts.show');
        Route::get('/delete/{district}', [DistrictController::class, 'delete'])->name('admin.districts.delete');
    });
    Route::group(['prefix' => 'control_point'], function (){
        Route::get('/', [ControlPointController::class, 'index'])->name('admin.control_points.index');
        Route::post('/', [ControlPointController::class, 'store'])->name('admin.control_points.store');
        Route::get('/create', [ControlPointController::class, 'create'])->name('admin.control_points.create');
        Route::get('/edit/{control_point}', [ControlPointController::class, 'edit'])->name('admin.control_points.edit');
        Route::post('/update/{control_point}', [ControlPointController::class, 'update'])->name('admin.control_points.update');
        Route::get('/show/{control_point}', [ControlPointController::class, 'show'])->name('admin.control_points.show');
        Route::get('/delete/{control_point}', [ControlPointController::class, 'delete'])->name('admin.control_points.delete');
    });
    Route::group(['prefix' => 'user'], function (){
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::get('/show/{user}', [UserController::class, 'show'])->name('admin.users.show');
        Route::patch('/add/control_point/{user}', [UserController::class, 'addControlPoint'])->name('admin.users.add.control_point');
        Route::get('/delete/{user}', [UserController::class, 'delete'])->name('admin.users.delete');
    });
});
