<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [ 'name', 'description' ];

    
    public function scopeRegistrable($query) {

        return $query->whereIn('name', ['admin', 'comercial']);
    }
}
