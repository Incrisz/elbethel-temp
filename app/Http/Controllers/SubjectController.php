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

        public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|unique:subjects,name,'.$subject->id.'|max:255'
        ]);

        $subject->update($validated);
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }
            public function destroy(Subject $subject)
        {
            $subject->delete();
            return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
        }
}