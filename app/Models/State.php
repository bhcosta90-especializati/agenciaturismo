<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function scopeByName($q, string $name = null){
        return $name ? $q->where('name', 'like', "%{$name}%") : $q;
    }
}
