<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarRentalAgency extends Model
{
    protected $fillable = [ 'name', 'address', 'city_id', 'ratings', 'votes' ];

    
    public function getAverageRatingAttribute() {

        return $this->votes === 0 ?: $this->ratings / $this->votes;
    }

    
    public function city() {

        return $this->belongsTo('App\City', 'city_id');
    }
}
