<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReglaIndividual extends Model
{
    use HasFactory;

    public function reglas()
    {
        return $this->hasOne(Regla::class, 'reglaset_id');
    }
}
