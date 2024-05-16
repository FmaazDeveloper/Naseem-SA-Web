<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\ContentController;
use App\Http\Controllers\API\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/profile/{user_email}', [ProfileController::class, 'index']);

Route::get('/administrative_regions', [ContentController::class, 'administrative_regions']);
Route::get('/regions/{administrative_region_id}', [ContentController::class, 'regions']);
Route::get('/landmarks/{region_id}', [ContentController::class, 'landmarks']);
Route::get('/activities/{landmark_id}', [ContentController::class, 'activities']);

Route::post('/contact_us', [TicketController::class, 'store']);
