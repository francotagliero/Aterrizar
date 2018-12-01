<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [ 'model', 'segment', 'price', 'range', 'brand_id', 'agency_id' ];


    public function agency() {

        return $this->belongsTo('App\CarRentalAgency', 'agency_id');
    }
    
    
    public function brand() {

        return $this->belongsTo('App\CarBrand', 'brand_id');
    }
}
