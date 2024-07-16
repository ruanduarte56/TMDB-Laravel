<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MoviesController::class,'index'])->name('index');
Route::get('/{filme}', [MoviesController::class,'show'])->name('filme');

