<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // List subjects
    public function index() {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    // Store new subject
    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:subjects']);
        Subject::create($request->all());
        return redirect()->back()->with('success', 'Subject created!');
    }
}