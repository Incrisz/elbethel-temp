<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillBehaviour extends Model
{
    use HasFactory;
    protected $table = 'skill_behaviours';
    protected $primaryKey = 'skill_behaviour_id';

    protected $fillable = [
        'student_id',
        'attentiveness',
        'perseverance',
        'promptness',
        'communication_skills',
        'handwriting',
        'punctuality',
        'neatness',
        'politeness',
        'honesty',
        'self_control',
    ];

    // Each skill behaviour record belongs to one student.
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
