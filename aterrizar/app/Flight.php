<?php

namespace App;

use App\AdminPanel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [ 'airline_id', 'city_from', 'city_to', 'date', 'time', 'duration', 'price', 'economy_seats', 'business_seats', 'first_class_seats' ];

    protected $dates = [ 'created_at', 'updated_at', 'date' ];

    public function from() {

        return $this->belongsTo('App\City', 'city_from');
    }
    
    
    public function to() {

        return $this->belongsTo('App\City', 'city_to');
    }


    public function airline() {

        return $this->belongsTo('App\Airline', 'airline_id');
    }


    public function scopeFromCity($query, $from) {

        return $query->whereHas('from', function ($query) use ($from) { 
            $query->where('id', $from->id); 
        });
    }


    public function scopeToCity($query, $to) {

        return $query->whereHas('to', function ($query) use ($to) { 
            $query->where('id', $to->id); 
        });
    }


    public function scopeForDate($query, $date) {

        return $query->where('date', $date);
    }


    public function scopeFromDate($query, $date) {

        return $query->where('date', '>=', $date);
    }
    
    
    public function scopeHavingSeats($query, $class, $seats) {

        return $query->where($this->seatsField($class), '>=', $seats);
    }


    private function seatsField($class) {

        switch ($class) {
            case 'Economy': return 'economy_seats';
            case 'Business': return 'business_seats';
            case 'First': return 'first_class_seats';
        }
    }
    
    public function durationInMinutes() {
        
        return Carbon::createFromTimeString($this->duration)->diffInMinutes(
            Carbon::createFromTimeString('00:00:00')
        );
    }
    
    
    public function priceForClass($class) {
        
        $factor = 1;
        switch ($class) {
            case 'Business': 
                $factor += AdminPanel::find(1)->bussinessclass_factor;
                break;
            case 'First': 
                $factor += AdminPanel::find(1)->firstsclass_factor;
        }
        return $factor * $this->price;
    }


    public function transaction() {

        return $this->morphOne('App\Transaction', 'service');
    }

    public function getServiceTypeAttribute() {

        return (new \ReflectionClass($this))->getShortName();
    }


    public function decreaseCapacity($seats, $class) {

        $this->{$this->seatsField($class)} = $this->{$this->seatsField($class)} - $seats;
    }


    public function increaseCapacity($seats, $class) {

        $this->{$this->seatsField($class)} = $this->{$this->seatsField($class)} + $seats;
    }
}
