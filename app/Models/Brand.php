<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function scopeByName($q, string $name = null){
        return !empty($name) ? $q->where('name', 'like', "%{$name}%") : $q;
    }

    public function planes()
    {
        return $this->hasMany(Plane::class);
    }
}
