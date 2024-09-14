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
}
