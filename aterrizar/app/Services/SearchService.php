<?php

namespace App\Services;

use App\{Car, Flight, Room};

class SearchService {

    public function oneStopFlights($from, $to, $date, $class, $seats) {

        //
    }
    
    
    public function nonStopFlights($from, $to, $date, $class, $seats) {
        
        return Flight::where([
            ['city_from', '=', $from],
            ['city_to', '=', $to],
            ['date', '=', $date],
            [$this->seatsField($class), '>=', $seats]
        ])->orderBy('price', 'ASC')->get();
    }


    private function seatsField($class) {

        switch ($class) {
            case 'Economy': return 'economy_seats';
            case 'Business': return 'business_seats';
            case 'First': return 'first_class_seats';
        }
    }


    public function rooms() {
        
        //
    }


    public function cars() {
        
        //
    }
}
