<?php

namespace App\Models;

use Costa\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory, Uuids;

    const STATUS_RESERVED = "reserved";
    const STATUS_CANCELED = "canceled";

    protected $fillable = [
        'user_id',
        'flight_id',
        'date_reserved',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function flight(){
        return $this->belongsTo(Flight::class);
    }

    public function status($op = null){
        $status = [
            self::STATUS_RESERVED => __('Reservado'),
            self::STATUS_CANCELED => __("Cancelado"),
            'paid' => __("Pago"),
            'concluded' => __("Concluído")
        ];

        if(empty($op)){
            return $status;
        }

        return $status[$op];
    }

    public function scopeByUserName($q, string $name = null){
        return !empty($name) ? $q->whereHas('user', function($q) use($name){
            $q->where('name', 'like', "%{$name}%");
        }) : $q;
    }

    public function scopeByUserEmail($q, string $email = null){
        return !empty($email) ? $q->whereHas('user', function($q) use($email){
            $q->where('email', 'like', "%{$email}%");
        }) : $q;
    }

    public function scopeByFlightUuid($q, string $uuid = null){
        return !empty($uuid) ? $q->whereHas('flight', function($q) use($uuid){
            $q->where('uuid', $uuid);
        }) : $q;
    }

    public function scopeByFlightDate($q, string $date = null){
        return !empty($date) ? $q->whereHas('flight', function($q) use($date){
            $q->where('date', $date);
        }) : $q;
    }

    public function scopeByStatus($q, string $status = null){
        return !empty($status) ? $q->where('status', $status) : $q;
    }
}
