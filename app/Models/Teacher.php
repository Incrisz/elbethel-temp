<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $primaryKey = 'teacher_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'subject_specialty',
        'email',
        'phone'
    ];

    // Many-to-many relationship with classes.
    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_teacher', 'teacher_id', 'class_id');
    }

    // Many-to-many relationship with subjects.
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject', 'teacher_id', 'subject_id');
    }

    // One-to-many relationship with attendance records.
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'teacher_id', 'teacher_id');
    }
}
