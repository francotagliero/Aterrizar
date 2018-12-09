<?php

namespace App\Services;

use App\{AdminPanel, Car, Flight, Room, CarRentalAgency};
use Carbon\Carbon;
use \Datetime;


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
        ])->orderBy('price', 'ASC')->get()->all();
}


private function seatsField($class) {

    switch ($class) {
        case 'Economy': return 'economy_seats';
        case 'Business': return 'business_seats';
        case 'First': return 'first_class_seats';
    }
}

    /*
    public function getHotelIdswithAmenities($amenities){
        $makeQuery= "";
        foreach ($amenities as $amenitie) {
            $makeQuery = "like" . $makeQuery . "%" .$amenitie . "%"
        }
            return $makeQuery;

    }
    */

    public function rooms($city, $capacity, $from, $to, $amenities) {
        //  $hotels=$this->getHotelIdswithAmenities($amenities);
        $rooms = Room::where([['capacity', '>=', $capacity] ])->get()->all();

        return array_filter($rooms, function ($room) use ($amenities) {
            $roomAmenities = json_decode($room->amenities);
            foreach ($amenities as $amenity) {
                if (! in_array($amenity, $roomAmenities)) {
                    return false;
                }
            }
            return true;
        });
    }

    public function cars($from, $to, $date_rent, $date_return, $brand, $agency) {


        $days=$this->getDaysDifference($date_rent,$date_return);

        $agencyId=$this->getAgencyIdByCity($from,$agency);
        $cars=  Car::select('model','segment','price','range','brand_id','agency_id')->where([
            ['agency_id', '=', $agencyId],
            ['brand_id', '=', $brand]
            ])->get();
        foreach ($cars as &$key) {
            $key['price']=$key['price']*$days;
        }
        return $cars;
    }

    public function getDaysDifference($from, $to){
        $from= new DateTime($from);
        $to= new DateTime($to);
        $days = $to->diff($from)->format("%a");
        return $days;
    }

    public function getAgencyIdByCity($from, $agency){

        $agencyName= CarRentalAgency::select('name')->where([
            ['id', '=', $agency]
            ])->get()->toArray();

        return CarRentalAgency::select('id')->where([
            ['city_id', '=', $from],
            ['name', '=', $agencyName]
            ])->get()->toArray();
    }
}
