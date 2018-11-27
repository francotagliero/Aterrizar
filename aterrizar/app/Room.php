<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function hotel() {

        return $this->belongsTo('App\Hotel', 'hotel_id');
    }
    
    
    public function city() {

        return $this->belongsTo('App\City', 'city_id');
    }
}
