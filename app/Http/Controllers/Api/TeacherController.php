<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    // Display a listing of teachers.
    public function index()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }

    // Store a newly created teacher in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'subject_specialty'=> 'nullable|string|max:255',
            'email'            => 'nullable',
            'phone'            => 'nullable'

        ]);

        $teacher = Teacher::create($validated);
        return response()->json($teacher, 201);
    }

    // Display the specified teacher.
    public function show($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        return response()->json($teacher);
    }

    // Update the specified teacher in storage.
    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $validated = $request->validate([
            'first_name'       => 'sometimes|required|string|max:255',
            'last_name'        => 'sometimes|required|string|max:255',
            'subject_specialty'=> 'nullable|string|max:255',
            'email'            => 'nullable',
            'phone'            => 'nullable'
        ]);

        $teacher->update($validated);
        return response()->json($teacher);
    }

    // Remove the specified teacher from storage.
    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted successfully']);
    }

    // Assign subject/subjects to Teacher
    public function assignSubjects(Request $request, $teacher_id)
    {
        // Validate that subject_ids is provided as an array and that each subject exists
        $validated = $request->validate([
            'subject_ids'   => 'required|array',
            'subject_ids.*' => 'required|exists:subjects,subject_id',
        ]);

        // Find the teacher by ID
        $teacher = Teacher::find($teacher_id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        // Attach the subjects to the teacher without removing existing assignments.
        $teacher->subjects()->syncWithoutDetaching($validated['subject_ids']);

        return response()->json(['message' => 'Subjects assigned to teacher successfully']);
    }

    // View the classes assigned to a specific teacher
    public function viewClasses($teacher_id)
    {
        // Retrieve the teacher along with their related classes
        $teacher = Teacher::with('classes')->find($teacher_id);

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        // Return only the classes assigned to the teacher
        return response()->json($teacher->classes);
    }

    // Update (edit) the classes assigned to a specific teacher
    public function updateClasses(Request $request, $teacher_id)
    {
        // Validate that class_ids is provided as an array and that each class exists in the classes table
        $validated = $request->validate([
            'class_ids'   => 'required|array',
            'class_ids.*' => 'required|exists:classes,class_id',
        ]);

        // Find the teacher by ID
        $teacher = Teacher::find($teacher_id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        // Sync the teacher's classes with the provided array.
        // This will remove any existing assignments not in the array and add new ones.
        $teacher->classes()->sync($validated['class_ids']);

        return response()->json(['message' => 'Teacher classes updated successfully']);
    }

    // View the subjects assigned to a specific teacher
    public function viewSubjects($teacher_id)
    {
        // Retrieve the teacher along with the related subjects
        $teacher = Teacher::with('subjects')->find($teacher_id);

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        // Return only the subjects assigned to the teacher
        return response()->json($teacher->subjects);
    }

    // Update (edit) the subjects assigned to a specific teacher
    public function updateSubjects(Request $request, $teacher_id)
    {
        // Validate that subject_ids is provided as an array and that each subject exists
        $validated = $request->validate([
            'subject_ids'   => 'required|array',
            'subject_ids.*' => 'required|exists:subjects,subject_id',
        ]);

        // Find the teacher by ID
        $teacher = Teacher::find($teacher_id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        // Sync the teacher's subjects with the provided array.
        // This will replace any existing subject assignments with the new list.
        $teacher->subjects()->sync($validated['subject_ids']);

        return response()->json(['message' => 'Teacher subjects updated successfully']);
    }



}
