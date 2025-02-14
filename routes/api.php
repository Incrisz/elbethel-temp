<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\V1\SubjectController;
use Illuminate\Http\Request;

// Route::middleware('api')->group(function () {
//     Route::apiResource('subjects', SubjectController::class);
// });

Route::apiResource('subjects', SubjectController::class);
