<?php

use App\Http\Controllers\StudyProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

