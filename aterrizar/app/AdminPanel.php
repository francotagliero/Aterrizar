<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPanel extends Model
{
   protected $table='admin_panel';
   protected $fillable = [ 'max_flight_duration', 'max_gap', 'percentage_stopover', 'return_tax', 'points_per_peso', 'pesos_per_point', 'firstclass_factor', 'bussinessclass_factor' ];
}
