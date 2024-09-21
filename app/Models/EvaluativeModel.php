<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluativeModel extends Model
{
    use HasFactory;
    protected $table = 'evaluative_models';

    protected $fillable = ['model_name'];

    public $timestamps = true;

    // -------------------------------
    public function works()
{
    return $this->hasMany(Work::class);
}
public function questions()
{
    return $this->hasMany(Question::class);
}
public function evaluations()
{
    return $this->hasMany(Evaluation::class);
}

}
