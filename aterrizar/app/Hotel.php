<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    
    protected $fillable = [ 'name', 'price', 'ratings', 'votes', 'stars', 'amenities', 'city_id' ];

    
    public function getAverageRatingAttribute() {

        return $this->votes === 0 ?: $this->ratings / $this->votes;
    }


    public function city() {

        return $this->belongsTo('App\City', 'city_id');
    }
}
