<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $primaryKey = 'term_id';

    protected $fillable = ['session_id', 'name'];

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id', 'session_id');
    }
}
