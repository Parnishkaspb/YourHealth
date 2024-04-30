<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Medic extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'login',
        'password',
        'email',
        'telephone',
        'id_profile_ambulance'
    ];

    /**
     * Хешировать пароль
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if ($value !== null && $value !== '') {
            $this->attributes['password'] = Hash::make($value);
        }
    }
    public function profileAmbulance()
    {
        return $this->belongsTo(ProfileAmbulance::class, 'id_profile_ambulance');
    }

    public function visits()
    {
        return $this->hasMany(MyVisit::class, 'id_medic');
    }
}
