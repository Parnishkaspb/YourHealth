<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'datetomedic',
        'timetomedic',
        'visit'
    ];
}
