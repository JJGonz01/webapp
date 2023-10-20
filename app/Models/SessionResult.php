<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionResult extends Model
{
    use HasFactory;

    public function session()
    {
        return $this->belongsTo(session::class, 'session_idc');
    }
}
