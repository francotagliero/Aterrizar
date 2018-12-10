<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function hotel() {

        return $this->belongsTo('App\Hotel', 'hotel_id');
    }

    
    public function transaction() {

        return $this->morphOne('App\Transaction', 'service');
    }

    
    public function getServiceTypeAttribute() {

        return (new \ReflectionClass($this))->getShortName();
    }

    public function priceForDates($from, $to, $capacity) {

        $from = new Carbon($from);
        $to = new Carbon($to);

        return $this->price * $capacity * $from->diffInDays($to);
    }

}
