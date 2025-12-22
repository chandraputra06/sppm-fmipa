<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudyProgramController;
use Illuminate\Support\Facades\Route;




Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::resource('study-programs',StudyProgramController::class);