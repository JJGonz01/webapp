<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public function therapy()
    {
        return $this->belongsTo(Therapy::class, 'therapy_id');
    }

    public function patient()
    {
        return $this->belongsTo(patient::class, 'patient_id');
    }

   
    public function sessionData()
    {
        return $this->hasMany(sessionData::class, 'sessiondata_id');
    }

    public function sessionResult()
    {
        return $this->hasOne(SessionResult::class, 'session_result_id');
    }

    public function regla()
    {
        return $this->hasOne(Regla::class);
    }

}
