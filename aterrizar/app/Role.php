<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  public function users(){
      return $this
          ->belongsToMany('App\User')
          ->withTimestamps();
  }

  public function admins(){
      return $this
          ->belongsToMany('App\Admin')
          ->withTimestamps();
  }

  public function comercials(){
      return $this
          ->belongsToMany('App\Comercial')
          ->withTimestamps();
  }
}
