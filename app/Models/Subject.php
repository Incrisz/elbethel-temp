<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $primaryKey = 'subject_id';

    protected $fillable = [
        'subject_name',
        'description',
    ];

    // Many-to-many relationship with classes.
    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_subject', 'subject_id', 'class_id');
    }

    // Many-to-many relationship with teachers.
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject', 'subject_id', 'teacher_id');
    }

    // One subject has many assessments.
    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'subject_id', 'subject_id');
    }

}
