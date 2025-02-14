<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'adm_no',
        'no_of_days_present',
        'class',
        'marks_obtainable',
        'marks_obtained',
        'average',
        'position',
        'teacher_comments'
    ];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function skillsBehavior()
    {
        return $this->hasOne(SkillBehavior::class);
    }
}
