<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['evaluative_model_id', 'question_text'];

    public function evaluativeModel()
    {
        return $this->belongsTo(EvaluativeModel::class);
    }
}