<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $primaryKey = 'session_id';

    protected $fillable = ['name', 'start_date', 'end_date'];

    public function terms()
    {
        return $this->hasMany(Term::class, 'session_id', 'session_id');
    }
}
