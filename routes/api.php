<?php

use App\Http\Controllers\StudyProgramController;
use Illuminate\Support\Facades\Route;


Route::resource('study-programs',StudyProgramController::class);