<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyRecomendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_visit',
        'id_user',
        'id_medic',
        'recomendation'
    ];
}
