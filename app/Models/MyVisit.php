<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_medic',
        'datetomedic',
        'timetomedic',
        'visit'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function medic()
    {
        return $this->belongsTo(Medic::class, 'id_medic');
    }

    public function recommendations()
    {
        return $this->hasMany(MyRecomendation::class, 'id_visit');
    }

}
