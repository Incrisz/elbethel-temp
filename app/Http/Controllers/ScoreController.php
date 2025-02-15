<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    // Show score entry form
    public function create(Student $student) {
        $subjects = Subject::all();
        return view('scores.create', compact('student', 'subjects'));
    }

    // Store scores
    public function store(Request $request, Student $student) {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'ca1' => 'required|integer|between:0,30',
            'ca2' => 'required|integer|between:0,30',
            'ca3' => 'required|integer|between:0,30',
            'exam' => 'required|integer|between:0,70',
            'position_in_subject' => 'required|integer|min:1',
            'class_average' => 'required|numeric|between:0,100',
            'lowest_in_class' => 'required|integer|min:0',
            'highest_in_class' => 'required|integer|min:0'
        ]);

        // Calculate total and grade
        $total = $data['ca1'] + $data['ca2'] + $data['ca3'] + $data['exam'];
        $data['total_marks'] = $total;
        $data['grade'] = $this->calculateGrade($total);
        $data['student_id'] = $student->id;
        

        Score::create($data);
        return redirect()->route('students.show', $student)->with('success', 'Scores added!');
    }

    private function calculateGrade($total) {
        if ($total >= 75) return 'A1';
        if ($total >= 70) return 'B2';
        if ($total >= 65) return 'B3';
        if ($total >= 60) return 'C4';
        if ($total >= 55) return 'C5';
        if ($total >= 50) return 'C6';
        if ($total >= 45) return 'D7';
        if ($total >= 40) return 'E8';
        return 'F9';
    }

        public function edit(Student $student, Score $score)
    {
        $subjects = Subject::all();
        return view('scores.edit', compact('student', 'score', 'subjects'));
    }

    public function update(Request $request, Student $student, Score $score)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'ca1' => 'required|integer|between:0,30',
            'ca2' => 'required|integer|between:0,30',
            'ca3' => 'required|integer|between:0,30',
            'exam' => 'required|integer|between:0,70',
            'position_in_subject' => 'required|integer|min:1',
            'class_average' => 'required|numeric|between:0,100',
            'lowest_in_class' => 'required|integer|min:0',
            'highest_in_class' => 'required|integer|min:0'
        ]);

        // Recalculate total and grade
        $total = $data['ca1'] + $data['ca2'] + $data['ca3'] + $data['exam'];
        $data['total_marks'] = $total;
        $data['grade'] = $this->calculateGrade($total);
        // dd($data);



        $score->update($data);

        return redirect()->route('students.show', $student)
            ->with('success', 'Score updated successfully!');
    }
}