<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\ParentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\StudentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('subjects', SubjectController::class);
Route::apiResource('classes', ClassController::class);
Route::apiResource('parents', ParentController::class);
Route::apiResource('teachers', TeacherController::class);
Route::apiResource('students', StudentController::class);

    //Assign Teacher to Class
Route::post('/classes/{class_id}/assign-teacher', [ClassController::class, 'assignTeacher']);
    // Assign Subjects to Class
Route::post('/classes/{class_id}/assign-subject', [ClassController::class, 'assignSubject']);
    // Assign subject/subjects to Teacher
Route::post('/teachers/{teacher_id}/assign-subjects', [TeacherController::class, 'assignSubjects']);
    // Assign Parent to students
Route::post('/parents/{parent_id}/assign-students', [ParentController::class, 'assignStudents']);

// Route to view classes assigned to a teacher
Route::get('/teachers/{teacher_id}/classes', [TeacherController::class, 'viewClasses']);

// Route to update (edit) classes assigned to a teacher
Route::put('/teachers/{teacher_id}/classes', [TeacherController::class, 'updateClasses']);


// Route to view subjects assigned to a class
Route::get('/classes/{class_id}/subjects', [ClassController::class, 'viewSubjects']);

// Route to update subjects assigned to a class
Route::put('/classes/{class_id}/subjects', [ClassController::class, 'updateSubjects']);

// Route to view subjects assigned to a teacher
Route::get('/teachers/{teacher_id}/subjects', [TeacherController::class, 'viewSubjects']);

// Route to update subjects assigned to a teacher
Route::put('/teachers/{teacher_id}/subjects', [TeacherController::class, 'updateSubjects']);
// Route to view students assigned to a parent
Route::get('/parents/{parent_id}/students', [ParentController::class, 'viewStudents']);

// Route to update students assigned to a parent
Route::put('/parents/{parent_id}/students', [ParentController::class, 'updateStudents']);
 // Gets all result and info of the student
Route::get('/students/{student_id}/result', [StudentController::class, 'getFullResult']);
