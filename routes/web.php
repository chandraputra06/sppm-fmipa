<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/authenticate', [AuthController::class, 'login'])->name('auth.login');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [AchievementController::class, 'index'])->name('admin.dashboard');

    Route::resource('study-programs', StudyProgramController::class);
    Route::resource('users', UserController::class);

    Route::prefix('achievement')->group(function () {
        Route::get('upload', [AchievementController::class, 'indexUpload'])->name('achievement.upload');
    });
    Route::resource('achievement', AchievementController::class);
});




Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/prestasi', function () {
    return view('prestasi.index');
})->name('prestasi.index');

// Route::resource('study-programs', StudyProgramController::class);

Route::get('/prestasi/{id}', function ($id) {
    return view('prestasi.show');
})->name('prestasi.show');
