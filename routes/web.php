<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandmarkController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


//regions
Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
Route::get('/regions/{region}',[RegionController::class,'show'])->name( 'regions.show');

Route::prefix('admin/')->group(function (){

    //regions
    Route::get('/regions', [RegionController::class, 'index_edit'])->name('regions.index_edit');
    Route::get('/regions/create',[RegionController::class,'create'])->name( 'regions.create');
    Route::post('/regions', [RegionController::class, 'store'])->name('regions.store');
    Route::get('/regions/{region}/edit',[RegionController::class,'edit'])->name( 'regions.edit');
    Route::put('/regions/{region}',[RegionController::class,'update'])->name( 'regions.update');
    Route::delete('/regions/{region}',[RegionController::class,'destroy'])->name( 'regions.destroy');

    //landmark
    Route::get('/landmarks/{region}', [LandmarkController::class, 'index'])->name('landmarks.index');
    Route::get('/landmarks/create/{region_id}',[LandmarkController::class,'create'])->name( 'landmarks.create');
    Route::post('/landmarks', [LandmarkController::class, 'store'])->name('landmarks.store');
    Route::get('/landmarks/{landmark}/edit',[LandmarkController::class,'edit'])->name( 'landmarks.edit');
    Route::put('/landmarks/{landmark}',[LandmarkController::class,'update'])->name( 'landmarks.update');
    Route::delete('/landmarks/{landmark}',[LandmarkController::class,'destroy'])->name( 'landmarks.destroy');

    //activity
    Route::get('/activities/{landmark}', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('/activities/create/{landmark_id}',[ActivityController::class,'create'])->name( 'activities.create');
    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
    Route::get('/activities/{activity}/edit',[ActivityController::class,'edit'])->name( 'activities.edit');
    Route::put('/activities/{activity}',[ActivityController::class,'update'])->name( 'activities.update');
    Route::delete('/activities/{activity}',[ActivityController::class,'destroy'])->name( 'activities.destroy');

});



