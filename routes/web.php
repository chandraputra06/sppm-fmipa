<?php

use App\Http\Controllers\StudyProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/prestasi', function () {
    return view('prestasi.index');
})->name('prestasi.index');

// Route::resource('study-programs',StudyProgramController::class);

Route::get('/prestasi/{id}', function ($id) {
    return view('prestasi.show');
})->name('prestasi.show');