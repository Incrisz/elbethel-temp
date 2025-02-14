<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SkillBehavior;
use Illuminate\Http\Request;

class SbController extends Controller
{
    // Show SB entry form
    public function edit(Student $student) {
        return view('sbs.edit', compact('student'));
    }

    // Update SB ratings
    public function update(Request $request, Student $student) {

        $data = $request->validate([
            'attentiveness' => 'required|integer|between:1,5',
            'perseverance' => 'required|integer|between:1,5',
            'promptness' => 'required|integer|between:1,5',
            'communication_skills' => 'required|integer|between:1,5',
            'handwriting' => 'required|integer|between:1,5',
            'punctuality' => 'required|integer|between:1,5',
            'neatness' => 'required|integer|between:1,5',
            'politeness' => 'required|integer|between:1,5',
            'honesty' => 'required|integer|between:1,5',
            'self_control' => 'required|integer|between:1,5'
        ]);

        SkillBehavior::updateOrCreate(
            ['student_id' => $student->id],
            $data
        );
        // dd('i got here');


        return redirect()->route('students.show', $student)->with('success', 'Behavior ratings updated!');
    }
}