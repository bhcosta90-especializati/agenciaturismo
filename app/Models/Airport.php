<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'latitude', 'longitude', 'address', 'number', 'zipcode', 'complement', 'city_id'
    ];

    public function scopeByCity($q, int $city = null)
    {
        return !empty($city) ? $q->where('city_id', $city) : $q;
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function scopeByName($q, string $name = null){
        return !empty($name) ? $q->where('name', 'like', "%{$name}%") : $q;
    }
}
