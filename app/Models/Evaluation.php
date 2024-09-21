<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['work_id', 'user_id', 'evaluative_model_id', 'responses'];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function evaluativeModel()
    {
        return $this->belongsTo(EvaluativeModel::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'evaluative_model_id', 'evaluative_model_id');
    }
}
