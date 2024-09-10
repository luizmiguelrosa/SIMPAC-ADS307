<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    // Definir o nome da tabela (opcional, se seguir o padrão Laravel)
    protected $table = 'courses';

    // Os campos que podem ser preenchidos
    protected $fillable = [
        'course_name',
        'course_abbreviation',
    ];

    // Caso você use timestamps e queira personalizá-los ou desativá-los
    public $timestamps = true;
}
