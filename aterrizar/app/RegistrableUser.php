<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrableUser extends Model
{
    	protected $fillable = [ 'email', 'role_id' ];

    public function role() {

        return $this->belongsTo('App\Role', 'role_id');
    }

}
