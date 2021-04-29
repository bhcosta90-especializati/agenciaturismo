<?php

namespace App\Models;

use Costa\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'plane_id',
        'airport_origin_id',
        'airport_destination_id',
        'image_id',
        'date',
        'time_duration',
        'hour_output',
        'arrival_time',
        'old_price',
        'price',
        'total_plots',
        'is_promotion',
        'qtd_stops',
        'description'
    ];

    protected $casts = [
        "is_promotion" => "boolean",
        "total_plots" => "integer",
        "qtd_stops" => "integer",
    ];

    public function plane(){
        return $this->belongsTo(Plane::class, 'plane_id');
    }

    public function reserves(){
        return $this->hasMany(Reserve::class)->where('status', '!=', Reserve::STATUS_CANCELED);
    }

    public function destination(){
        return $this->belongsTo(Airport::class, 'airport_destination_id');
    }

    public function origin(){
        return $this->belongsTo(Airport::class, 'airport_origin_id');
    }

    public function scopeByUuid($q, string $uuid = null){
        return !empty($uuid) ? $q->where('uuid', $uuid) : $q;
    }

    public function scopeByDate($q, string $date = null){
        return !empty($date) ? $q->where('date', '>=', $date) : $q;
    }

    public function scopeByHourOutput($q, string $hourOutput = null){
        return !empty($hourOutput) ? $q->where('hour_output', $hourOutput) : $q;
    }

    public function scopeByQtdStops($q, string $qtdStops = null){
        return !empty($qtdStops) ? $q->where('qtd_stops', $qtdStops) : $q;
    }

    public function scopeByOrigin($q, int $airport = null){
        return !empty($airport) ? $q->where('airport_origin_id', $airport) : $q;
    }

    public function scopeByDestination($q, int $airport = null){
        return !empty($airport) ? $q->where('airport_destination_id', $airport) : $q;
    }
}
