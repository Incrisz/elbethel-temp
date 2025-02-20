<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show all students
    public function index(Request $request) {
        
        // $students = Student::with(['scores', 'skillsbehavior'])->get();
        $query = Student::with(['scores', 'skillsbehavior']);

        // Check if a search query exists
        if ($request->has('search')) {
            $search = $request->input('search');
            $query = $query->where('name', 'LIKE', "%{$search}%")
                           ->orWhere('class', 'LIKE', "%{$search}%");
        }
    
        // Execute the query
        $students = $query->get();


        return view('students.index', compact('students'));
    }

    // Show create form
    public function create() {
        return view('students.create');
    }

    // Store new student
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'adm_no' => 'required|unique:students,adm_no',
            'no_of_days_present' => 'required|integer|min:0',
            'class' => 'required|string|max:50',
            'marks_obtainable' => 'required|integer|min:0',
            'marks_obtained' => 'required|integer|min:0',
            'average' => 'nullable',
            'position' => 'nullable',
            'teacher_comments' => 'nullable|string',
            'no_in_class' => 'nullable',
            'principal_comments' => 'nullable',
            'session' => 'nullable',
            'term' => 'nullable'
        ]);
        // dd("i got here");
    // Calculate average if needed
    if($data['marks_obtainable'] > 0) {
        $data['average'] = ($data['marks_obtained'] / $data['marks_obtainable']) * 100;
    }

        Student::create($data);
        return redirect()->route('students.index')->with('success', 'Student created!');
    }

    public function show(Student $student) {
        $student->load(['scores.subject', 'skillsbehavior']);
        return view('students.show', compact('student'));
    }

    // Show edit form
    public function edit(Student $student) {
        return view('students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, Student $student) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'adm_no' => 'required',
            'no_of_days_present' => 'required|integer|min:0',
            'class' => 'required|string|max:50',
            'marks_obtainable' => 'required|integer|min:0',
            'marks_obtained' => 'required|integer|min:0',
            'average' => 'nullable',
            'position' => 'nullable',
            'teacher_comments' => 'nullable|string',
            'no_in_class' => 'nullable',
            'principal_comments' => 'nullable',
            'session' => 'nullable',
            'term' => 'nullable'
        ]);
        // dd("i got here");
    // Calculate average if needed
        if($data['marks_obtainable'] > 0) {
            $data['average'] = ($data['marks_obtained'] / $data['marks_obtainable']) * 100;
        }

        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Student updated!');
    }

        // Add to StudentController
    public function promote(Student $student)
    {
        if (!$student->class->nextClass) {
            return redirect()->back()->with('error', 'No next class defined for promotion');
        }

        $student->update(['class_id' => $student->class->next_class_id]);
        return redirect()->back()->with('success', 'Student promoted successfully!');
    }

    public function bulkPromote(ClassModel $class)
    {
        if (!$class->nextClass) {
            return redirect()->back()->with('error', 'No next class defined for promotion');
        }

        $class->students()->update(['class_id' => $class->next_class_id]);
        return redirect()->back()->with('success', 'All students promoted successfully!');
    }

    
}