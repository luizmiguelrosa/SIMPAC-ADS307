<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Work extends Model
{
    protected $fillable = ['protocol','overview', 'course_id', 'evaluative_model_id','category_id'];

    // Relacionamento com Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function evaluators()
    {
        return $this->belongsToMany(User::class, 'work_evaluator'); // Ajuste conforme o nome da tabela de relacionamento
    }
    public function evaluative_model()
    {
        return $this->belongsTo(EvaluativeModel::class, 'evaluative_model_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
}
