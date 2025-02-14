<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class SkillBehavior extends Model
{
    use HasFactory;

    protected $table = 'skills_behavior';

    protected $fillable = [
        'student_id', 'attentiveness', 'perseverance', 'promptness',
        'communication_skills', 'handwriting', 'punctuality', 'neatness',
        'politeness', 'honesty', 'self_control'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
