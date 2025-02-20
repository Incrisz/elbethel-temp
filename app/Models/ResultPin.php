<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultPin extends Model
{
    use HasFactory;
    protected $primaryKey = 'pin_id';

    protected $fillable = [
        'pin_code',
        'student_id',
    ];

    // Each result pin can be linked to one student.
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
