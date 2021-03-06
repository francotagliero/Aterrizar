<?php

namespace App;

use Carbon\Carbon;
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

    
    public function transaction() {

        return $this->morphOne('App\Transaction', 'service');
    }

    
    public function getServiceTypeAttribute() {

        return (new \ReflectionClass($this))->getShortName();
    }


    public function priceForDates($dateRent, $dateReturn) {

        $dateRent = new Carbon($dateRent);
        $dateReturn = new Carbon($dateReturn);

        return $this->price * $dateRent->diffInDays($dateReturn);
    }
}
