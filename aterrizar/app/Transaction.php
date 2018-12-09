<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    
    public function scopeForLoggedUser($query) {

        return $query->whereHas('user', function ($query) { 
            $query->where('id', Auth::user()->id); 
        });
    }


    public function scopeInCart($query) {

        return $query->where('status', 'En Carrito');
    }


    public function scopeBought($query) {

        return $query->where('status', '<>', 'En Carrito');
    }
}
