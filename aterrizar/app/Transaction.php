<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $fillable = [ 'service_type', 'service_id', 'user_id', 'points', 'points_given', 'price', 'status', 'from', 'to', 'extra'];

    protected $casts = [ 'extra' => 'json' ];
    
    
    public function service() {

        return $this->morphTo();
    }


	public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
