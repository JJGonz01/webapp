<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Therapy;
use App\Models\Behavior;
use App\Models\user;
use App\Models\Physiological;

class Patient extends Model
{
    use HasFactory;

    public function session()
    {
        return $this->hasMany(Session::class);
    } 

    public function physiological()
    {
        return $this->hasMany(Physiological::class, 'physiological_id');
    }

    public function behavior()
    {
        return $this->hasMany(Behavior::class, 'behavior_id');
    }

    public function therapies()
    {
        return $this->belongsToMany(Therapies::class, 'ter_pats');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}
