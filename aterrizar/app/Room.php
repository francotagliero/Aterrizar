<?php

namespace App;

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
}
