<?php

namespace App\Services;

use App\{AdminPanel, Car, Flight, Room};
use Carbon\Carbon;

class SearchService {

    public function oneStopFlights($from, $to, $date, $class, $seats) {

        $flights = [];
        $settings = AdminPanel::find(1);
        foreach (Flight::where([
            ['city_from', '=', $from],
            ['date', '=', $date],
            [$this->seatsField($class), '>=', $seats]
        ])->orderBy('price', 'ASC')->get() as $flight_from) {

            foreach (Flight::where([
                ['city_from', '=', $flight_from->to->id],
                ['city_to', '=', $to],
                ['date', '>=', $date],
                [$this->seatsField($class), '>=', $seats]
            ])->get() as $flight_to) {

                if (empty($flight_to)) { continue; }
                $gap = $this->getGap($flight_from, $flight_to);
                if ($gap < 0) { continue; }
                if ($gap > $settings->max_gap) { continue; }
                $duration = $gap + floor(
                    ($this->durationInMinutes($flight_to->duration) + $this->durationInMinutes($flight_from->duration)) 
                    / 60
                );
                if ($duration > $settings->max_flight_duration) { continue; }
                $flights[] = $flight_from;
                $flights[] = $flight_to;
            }
        }
        return $flights;
    }


    private function getGap($flight_from, $flight_to) {

        $from_dt = new Carbon("{$flight_from->date->format('Y-m-d')} {$flight_from->time}");
        $to_dt = new Carbon("{$flight_to->date->format('Y-m-d')} {$flight_to->time}");
        $from_dt->addHours(substr($flight_from->duration, 0, 2));
        $from_dt->addMinutes(substr($flight_from->duration, 3, 2));

        return $from_dt->diffInHours($to_dt, false);
    }


    private function durationInMinutes($duration) {

        $duration = explode(':', $duration);
        return $duration[0] * 60 + $duration[1];
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
