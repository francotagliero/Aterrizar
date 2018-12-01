<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [ 'airline_id', 'city_from', 'city_to', 'date', 'time', 'duration', 'price', 'economy_seats', 'business_seats', 'first_class_seats' ];

    protected $dates = [ 'created_at', 'updated_at', 'date' ];

    public function from() {

        return $this->belongsTo('App\City', 'city_from');
    }
    
    
    public function to() {

        return $this->belongsTo('App\City', 'city_to');
    }


    public function airline() {

        return $this->belongsTo('App\Airline', 'airline_id');
    }
}
