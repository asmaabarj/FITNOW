<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProgressController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication routes
Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);

// Progress routes 

// Route::put('/progress/{id}', [ProgressController::class, 'updateProgress']); 
// Route::delete('/progress/{id}', [ProgressController::class, 'deleteProgress']);
// Route::get('/progress', [ProgressController::class, 'getUserProgress']); 
// Route::get('/progress/{id}', [ProgressController::class, 'getProgress']);



Route::middleware('auth:sanctum')->group(function ()  {
    Route::post('/progress', [ProgressController::class, 'store']); 
});