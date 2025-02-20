<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display a listing of students.
    public function index()
    {
        // Eager load relationships as needed
        $students = Student::with(['schoolClass', 'parents', 'assessments', 'skillBehaviour'])->get();
        return response()->json($students);
    }

    // Store a newly created student in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'other_name'      => 'nullable|string|max:255',
            'date_of_birth'   => 'nullable|date',
            'address'         => 'nullable|string',
            'profile_picture' => 'nullable|string',
            'class_id'        => 'required|exists:classes,class_id',
            'section'         => 'nullable|string|max:255',
            'term'            => 'nullable|string|max:255',
        ]);

        $student = Student::create($validated);
        return response()->json($student, 201);
    }

    // Display the specified student.
    public function show($id)
    {
        $student = Student::with(['schoolClass', 'parents', 'assessments', 'skillBehaviour'])->find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    // Update the specified student in storage.
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validated = $request->validate([
            'first_name'      => 'sometimes|required|string|max:255',
            'last_name'       => 'sometimes|required|string|max:255',
            'other_name'      => 'nullable|string|max:255',
            'date_of_birth'   => 'nullable|date',
            'address'         => 'nullable|string',
            'profile_picture' => 'nullable|string',
            'class_id'        => 'sometimes|required|exists:classes,class_id',
            'section'         => 'nullable|string|max:255',
            'term'            => 'nullable|string|max:255',
        ]);

        $student->update($validated);
        return response()->json($student);
    }

    // Remove the specified student from storage.
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }

        // Gets all result and info of the student
    public function getFullResult($student_id)
    {
        // Retrieve the student along with all related details:
        // - schoolClass with its teachers and subjects
        // - attendance records
        // - skill behaviour
        // - assessments along with the subject details
        // - parent's details
        $student = Student::with([
            'schoolClass.teachers',
            'schoolClass.subjects',
            // 'attendance',
            'skillBehaviour',
            'assessments.subject',
            'parents'
        ])->find($student_id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

}
