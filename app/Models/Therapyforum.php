<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapyforum extends Model
{
    use HasFactory;

    public function therapies()
    {
        return $this->belongsTo(therapies::class);
    }
}
