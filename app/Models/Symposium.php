<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symposium extends Model
{
    use HasFactory;

    protected $table = 'symposium';

    protected $fillable = [
        'edition',
        'start_date',
        'end_date',
    ];
}