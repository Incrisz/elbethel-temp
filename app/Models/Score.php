<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'ca1',
        'ca2',
        'ca3',
        'exam',
        'grade',
        'position_in_subject',
        'class_average',
        'lowest_in_class',
        'highest_in_class'
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
