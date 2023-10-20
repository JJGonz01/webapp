<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\patient;

class Therapy extends Model
{
    use HasFactory;

    public function sessions()
    {
        return $this->hasMany(Session::class, 'session_id');
    }

    public function patients()
    {
        return $this->belongsToMany(patient::class, 'ter_pats');
    }

    public function regla()
    {
        return $this->hasOne(Regla::class, 'regla');
    }

}
