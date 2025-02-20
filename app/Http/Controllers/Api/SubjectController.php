<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    // Display a listing of subjects.
    public function index()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }

    // Store a newly created subject in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
        ]);

        $subject = Subject::create($validated);
        return response()->json($subject, 201);
    }

    // Display the specified subject.
    public function show($id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        return response()->json($subject);
    }

    // Update the specified subject in storage.
    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        $validated = $request->validate([
            'subject_name' => 'sometimes|required|string|max:255',
            'description'  => 'nullable|string',
        ]);

        $subject->update($validated);
        return response()->json($subject);
    }

    // Remove the specified subject from storage.
    public function destroy($id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        $subject->delete();
        return response()->json(['message' => 'Subject deleted successfully']);
    }
}
