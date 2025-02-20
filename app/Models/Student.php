<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'other_name',
        'date_of_birth',
        'address',
        'profile_picture',
        'class_id',
        'section',
        'term',
    ];

    // Each student belongs to one class.
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    // Many-to-many relationship with parents.
    public function parents()
    {
        return $this->belongsToMany(ParentModel::class, 'parent_student', 'student_id', 'parent_id');
    }

    // One-to-many relationship with assessments.
    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'student_id');
    }

    // One-to-one relationship with skill behaviour.
    public function skillBehaviour()
    {
        return $this->hasOne(SkillBehaviour::class, 'student_id');
    }

    // One-to-many relationship with attendance records.
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}
