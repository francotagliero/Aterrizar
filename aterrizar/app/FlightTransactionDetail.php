<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightTransactionDetail extends Model
{
    
    public function transaction() {

        return $this->morphOne('App\Transaction', 'detail');
    }


    public function stop() {
    
        return $this->belongsTo('App\Flight', 'stop_id');
    }
}
