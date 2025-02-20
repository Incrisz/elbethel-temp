<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    protected $primaryKey = 'assessment_id';

    protected $fillable = [
        'student_id',
        'subject_id',
        'CA1',
        'CA2',
        'CA3',
        'exam',
        'position_in_subject',
        'class_average',
        'lowest_in_class',
        'highest_in_class',
    ];

    // Each assessment belongs to a student.
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    // Each assessment belongs to a subject.
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }
}
