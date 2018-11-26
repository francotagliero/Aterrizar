<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function from() {

        return $this->belongsTo('App\City', 'city_from');
    }
    
    
    public function to() {

        return $this->belongsTo('App\City', 'city_to');
    }
}
