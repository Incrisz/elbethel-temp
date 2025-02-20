<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $primaryKey = 'class_id';

    protected $fillable = [
        'class_name',
        'arm',
        'section',
    ];

    // One class has many students.
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'class_id');
    }

    // Many-to-many relationship with teachers.
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_teacher', 'class_id', 'teacher_id');
    }

    // Many-to-many relationship with subjects.
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject', 'class_id', 'subject_id');
    }

    // One-to-many relationship with attendance records.
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'class_id', 'class_id');
    }
}
