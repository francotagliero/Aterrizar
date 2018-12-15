<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{

    const STATUS_INCART    = 'En Carrito';
    const STATUS_BOUGHT    = 'Comprado';
    const STATUS_CANCELLED = 'Cancelado';
    const STATUS_CONSUMED  = 'Consumido';

	protected $fillable = [ 'service_type', 'service_id', 'user_id', 'points', 'points_given', 'price', 'status', 'from', 'to', 'extra'];

    protected $casts = [ 'extra' => 'json' ];

    
    public function service() {

        return $this->morphTo();
    }


    public function detail() {

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

    
    public function scopeForUser($query, $user) {

        return $query->whereHas('user', function ($query) use ($user) { 
            $query->where('id', $user->id); 
        });
    }


    public function scopeInCart($query) {

        return $query->where('status', self::STATUS_INCART);
    }


    public function scopeBought($query) {

        return $query->where('status', self::STATUS_BOUGHT);
    }


    public function scopeNotInCart($query) {

        return $query->where('status', '<>', self::STATUS_INCART);
    }
}
