<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class therapy_session_completed extends Model
{
    use HasFactory;

    public function session()
    {
        return $this->hasOne(Session::class, 'session_id');
    }
}