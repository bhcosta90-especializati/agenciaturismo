<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'brand_id',
        'qtd_passengers',
        'class',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeByBrand($q, int $brand = null){
        return !empty($brand) ? $q->where('brand_id', $brand) : $q;
    }

    public function scopeBySKU($q, int $sku = null){
        return !empty($sku) ? $q->where('sku', $sku) : $q;
    }

    public function scopeByClass($q, string $class = null){
        return !empty($class) ? $q->where('class', $class) : $q;
    }

    public function class($class = null){
        $classess = [
            'economy' => 'Econômica',
            'luxury' => 'Luxuoso',
        ];

        if(empty($class)){
            return $classess;
        }

        return $classess[$class];
    }
}
