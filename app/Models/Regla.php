<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regla extends Model
{
    use HasFactory;
    public function session()
    {
        return $this->belongsTo(Session::class);
        
    }

    public function therapy()
    {
        return $this->belongsTo(Therapy::class);
        
    }
}
