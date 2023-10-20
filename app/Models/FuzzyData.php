<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuzzyData extends Model
{
    use HasFactory;
    public function therapy()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

}
