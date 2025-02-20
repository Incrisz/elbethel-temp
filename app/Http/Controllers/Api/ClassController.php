<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolClass;

class ClassController extends Controller
{
    // Display a listing of classes.
    public function index()
    {
        $classes = SchoolClass::all();
        return response()->json($classes);
    }

    // Store a newly created class in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_name' => 'required|string|max:255',
            'arm'        => 'nullable|string',
            'section'    => 'nullable|string',
        ]);

        $schoolClass = SchoolClass::create($validated);
        return response()->json($schoolClass, 201);
    }

    // Display the specified class.
    public function show($id)
    {
        $schoolClass = SchoolClass::find($id);

        if (!$schoolClass) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        return response()->json($schoolClass);
    }

    // Update the specified class in storage.
    public function update(Request $request, $id)
    {
        $schoolClass = SchoolClass::find($id);

        if (!$schoolClass) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $validated = $request->validate([
            'class_name' => 'sometimes|required|string|max:255',
            'arm'        => 'nullable|string',
            'section'    => 'nullable|string',
        ]);

        $schoolClass->update($validated);
        return response()->json($schoolClass);
    }

    // Remove the specified class from storage.
    public function destroy($id)
    {
        $schoolClass = SchoolClass::find($id);

        if (!$schoolClass) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $schoolClass->delete();
        return response()->json(['message' => 'Class deleted successfully']);
    }

    // Assign Teacher to Class
    public function assignTeacher(Request $request, $class_id)
    {
        // Validate that teacher_id is provided and exists in the teachers table.
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,teacher_id',
        ]);

        // Find the class by ID.
        $schoolClass = SchoolClass::find($class_id);
        if (!$schoolClass) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        // Use the relationship to attach the teacher to this class.
        // Using syncWithoutDetaching prevents removing existing teachers.
        $schoolClass->teachers()->syncWithoutDetaching([$validated['teacher_id']]);

        return response()->json(['message' => 'Teacher assigned to class successfully']);
    }

    // Assign Subjects to Class
    public function assignSubject(Request $request, $class_id)
    {
        // Validate that subject_id is provided and exists in the subjects table.
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,subject_id',
        ]);

        // Find the class by its ID.
        $schoolClass = SchoolClass::find($class_id);
        if (!$schoolClass) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        // Attach the subject to the class without removing existing ones.
        $schoolClass->subjects()->syncWithoutDetaching([$validated['subject_id']]);

        return response()->json(['message' => 'Subject assigned to class successfully']);
    }

    // View the subjects assigned to a specific class
    public function viewSubjects($class_id)
    {
        // Retrieve the class along with its related subjects
        $schoolClass = SchoolClass::with('subjects')->find($class_id);

        if (!$schoolClass) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        // Return only the subjects assigned to the class
        return response()->json($schoolClass->subjects);
    }

    // Update (edit) the subjects assigned to a specific class
    public function updateSubjects(Request $request, $class_id)
    {
        // Validate that subject_ids is provided as an array and that each subject exists
        $validated = $request->validate([
            'subject_ids'   => 'required|array',
            'subject_ids.*' => 'required|exists:subjects,subject_id',
        ]);

        // Find the class by its ID
        $schoolClass = SchoolClass::find($class_id);
        if (!$schoolClass) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        // Sync the class's subjects with the provided array.
        // This replaces any existing assignments with the new list.
        $schoolClass->subjects()->sync($validated['subject_ids']);

        return response()->json(['message' => 'Subjects updated successfully']);
    }



}
