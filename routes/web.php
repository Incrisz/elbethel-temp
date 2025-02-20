<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SbController;
use App\Http\Controllers\ClassController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::middleware(['auth'])->group(function () {


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Students
Route::resource('students', StudentController::class);

// Scores
Route::get('students/{student}/scores/create', [ScoreController::class, 'create'])->name('scores.create');
Route::post('students/{student}/scores', [ScoreController::class, 'store'])->name('scores.store');

// Edit Score Form
Route::get('/students/{student}/scores/{score}/edit', [ScoreController::class, 'edit'])
     ->name('scores.edit');

// Update Score
Route::put('/students/{student}/scores/{score}', [ScoreController::class, 'update'])
     ->name('scores.update');

// Behavior
Route::get('students/{student}/behavior', [SbController::class, 'edit'])->name('sbs.edit');
Route::put('students/{student}/behavior', [SbController::class, 'update'])->name('sbs.update');

// Subjects
Route::resource('subjects', SubjectController::class)->except(['show', 'edit', 'update']);

// Edit Subject
Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');

// web.php
Route::resource('classes', ClassController::class);
// Route::post('/students/{student}/promote', [StudentController::class, 'promote'])->name('students.promote');
// Route::post('/classes/{class}/bulk-promote', [ClassController::class, 'bulkPromote'])->name('classes.bulk-promote');

// });
