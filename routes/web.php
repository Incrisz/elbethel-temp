<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SbController;



Route::get('/', function () {
    return view('welcome');
});


// Students
Route::resource('students', StudentController::class);

// Scores
Route::get('students/{student}/scores/create', [ScoreController::class, 'create'])->name('scores.create');
Route::post('students/{student}/scores', [ScoreController::class, 'store'])->name('scores.store');

// Behavior
Route::get('students/{student}/behavior', [SbController::class, 'edit'])->name('sbs.edit');
Route::put('students/{student}/behavior', [SbController::class, 'update'])->name('sbs.update');

// Subjects
Route::resource('subjects', SubjectController::class)->except(['show', 'edit', 'update']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
