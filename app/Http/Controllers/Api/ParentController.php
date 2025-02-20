<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentModel;

class ParentController extends Controller
{
    // Display a listing of parents.
    public function index()
    {
        $parents = ParentModel::all();
        return response()->json($parents);
    }

    // Store a newly created parent in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'contact_info' => 'nullable|string',
        ]);

        $parent = ParentModel::create($validated);
        return response()->json($parent, 201);
    }

    // Display the specified parent.
    public function show($id)
    {
        $parent = ParentModel::find($id);

        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        return response()->json($parent);
    }

    // Update the specified parent in storage.
    public function update(Request $request, $id)
    {
        $parent = ParentModel::find($id);

        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        $validated = $request->validate([
            'name'         => 'sometimes|required|string|max:255',
            'contact_info' => 'nullable|string',
        ]);

        $parent->update($validated);
        return response()->json($parent);
    }

    // Remove the specified parent from storage.
    public function destroy($id)
    {
        $parent = ParentModel::find($id);

        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        $parent->delete();
        return response()->json(['message' => 'Parent deleted successfully']);
    }

    // Assign Parent to students
    public function assignStudents(Request $request, $parent_id)
    {
        // Validate that student_ids is provided as an array and that each student exists
        $validated = $request->validate([
            'student_ids'   => 'required|array',
            'student_ids.*' => 'required|exists:students,student_id',
        ]);

        // Find the parent by ID.
        $parent = ParentModel::find($parent_id);
        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        // Attach the students to the parent without removing existing associations.
        $parent->students()->syncWithoutDetaching($validated['student_ids']);

        return response()->json(['message' => 'Students assigned to parent successfully']);
    }

    // View the students assigned to a specific parent
    public function viewStudents($parent_id)
    {
        // Retrieve the parent along with the related students
        $parent = ParentModel::with('students')->find($parent_id);

        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        // Return the students assigned to the parent
        return response()->json($parent->students);
    }

    // Update (edit) the students assigned to a specific parent
    public function updateStudents(Request $request, $parent_id)
    {
        // Validate that student_ids is provided as an array and that each student exists in the students table
        $validated = $request->validate([
            'student_ids'   => 'required|array',
            'student_ids.*' => 'required|exists:students,student_id',
        ]);

        // Find the parent by ID
        $parent = ParentModel::find($parent_id);
        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        // Sync the parent's students with the provided array.
        // This will replace any existing associations with the new set.
        $parent->students()->sync($validated['student_ids']);

        return response()->json(['message' => 'Parent\'s students updated successfully']);
    }


}
