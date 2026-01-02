<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware(['auth', 'role:1,2'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AchievementController::class, 'index'])->name('admin.dashboard');

    Route::resource('study-programs', StudyProgramController::class);
    Route::resource('users', UserController::class);

    Route::prefix('achievements')->group(function () {
        Route::post('', [AchievementController::class, 'store'])->name('achievements.store');
        Route::get('create', [AchievementController::class, 'create'])->name('achievements.create');
        Route::get('{achievement}/edit', [AchievementController::class, 'edit'])->name('achievements.edit');
        Route::put('{achievement}', [AchievementController::class, 'update'])->name('achievements.update');
        Route::delete('{achievement}', [AchievementController::class, 'destroy'])->name('achievements.destroy');

        // Upload & Download Template
        Route::get('upload', [AchievementController::class, 'indexUpload'])->name('achievements.upload');
        Route::post('import', [AchievementController::class, 'import'])->name('achievements.import');
        Route::get('download-template', [AchievementController::class, 'downloadTemplate'])->name('achievements.downloadTemplate');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/prestasi', [StudentController::class, 'studentAchievements'])->name('prestasi.index');
    Route::get('/prestasi/{student}', [StudentController::class, 'show'])->name('prestasi.show');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/', [AchievementController::class, 'userHompage'])->name('homepage');
