<?php

namespace App\Http\Controllers;
use App\Models\ClassModel;

use Illuminate\Http\Request;

class ClassController extends Controller
{
     // Index - List all classes
     public function index()
     {
         $classes = ClassModel::withCount('students')->get();
         return view('classes.index', compact('classes'));
     }
 
     // Create Form
     public function create()
     {
         $classes = ClassModel::all();
         return view('classes.create', compact('classes'));
     }
 
     // Store New Class
     public function store(Request $request)
     {
         $data = $request->validate([
             'name' => 'required|string|max:255',
             'arm' => 'required|string|max:10',
             'description' => 'nullable|string',
             'next_class_id' => 'nullable|exists:classes,id'
         ]);
 
         ClassModel::create($data);
         return redirect()->route('classes.index')->with('success', 'Class created!');
     }
 
     // Edit Form
     public function edit(ClassModel $class)
     {
         $classes = ClassModel::where('id', '!=', $class->id)->get();
         return view('classes.edit', compact('class', 'classes'));
     }
 
     // Update Class
     public function update(Request $request, ClassModel $class)
     {
         $data = $request->validate([
             'name' => 'required|string|max:255',
             'arm' => 'required|string|max:10',
             'description' => 'nullable|string',
             'next_class_id' => 'nullable|exists:classes,id'
         ]);
 
         $class->update($data);
         return redirect()->route('classes.index')->with('success', 'Class updated!');
     }
 
     // Delete Class
     public function destroy(ClassModel $class)
     {
         if($class->students()->exists()) {
             return redirect()->back()->with('error', 'Cannot delete class with students!');
         }
         
         $class->delete();
         return redirect()->route('classes.index')->with('success', 'Class deleted!');
     }
     
}
