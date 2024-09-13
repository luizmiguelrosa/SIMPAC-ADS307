<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Work extends Model
{
    protected $fillable = ['protocol', 'course_id'];

    // Definir o relacionamento com Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
