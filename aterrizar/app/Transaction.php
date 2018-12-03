<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $fillable = [ 'service_name', 'service_id', 'user_id', 'points', 'points_given', 'price' ];


	public function service($service) {
		if($service=='Room'){
			return $this->belongsTo('App\Room', 'service_name');
		}   
		else if($service=='Flight'){
			return $this->belongsTo('App\Flight', 'service_name');
		}
		else{
			return $this->belongsTo('App\Car', 'service_name');
		}
	}

	public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
