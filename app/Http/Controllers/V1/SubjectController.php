<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
   // Get all subjects
   public function index()
   {
       return response()->json(Subject::all(), 200);
   }

   // Store a new subject
   public function store(Request $request)
   {
       $request->validate(['name' => 'required|unique:subjects|max:255']);

       $subject = Subject::create($request->all());

       return response()->json($subject, 201);
   }

   // Show a single subject
   public function show($id)
   {
       $subject = Subject::find($id);

       if (!$subject) {
           return response()->json(['message' => 'Subject not found'], 404);
       }

       return response()->json($subject, 200);
   }

   // Update a subject
   public function update(Request $request, $id)
   {
       $subject = Subject::find($id);

       if (!$subject) {
           return response()->json(['message' => 'Subject not found'], 404);
       }

       $request->validate(['name' => 'required|unique:subjects,name,' . $id]);

       $subject->update($request->all());

       return response()->json($subject, 200);
   }

   // Delete a subject
   public function destroy($id)
   {
       $subject = Subject::find($id);

       if (!$subject) {
           return response()->json(['message' => 'Subject not found'], 404);
       }

       $subject->delete();

       return response()->json(['message' => 'Subject deleted successfully'], 200);
   }
}
