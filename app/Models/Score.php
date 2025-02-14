<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'subject_id', 'CA1', 'CA2', 'CA3', 'exam',
        'total_marks', 'grade', 'position_in_subject', 'class_average',
        'lowest_in_class', 'highest_in_class'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
