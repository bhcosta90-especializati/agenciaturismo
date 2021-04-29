<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function scopeByState($q, int $stateId = null){
        return !empty($stateId) ? $q->where('state_id', $stateId) : $q;
    }

    public function scopeByName($q, string $name = null){
        return !empty($name) ? $q->where('name', 'like', "%{$name}%") : $q;
    }

    public function airports()
    {
        return $this->hasMany(Airport::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }
}
