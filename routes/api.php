<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\V1\SubjectController;

Route::apiResource('subjects', SubjectController::class);
