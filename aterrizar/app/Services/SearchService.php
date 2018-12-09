<?php

namespace App\Services;

use App\{AdminPanel, Car, City, Flight, Room, CarRentalAgency};
use Carbon\Carbon;
use \Datetime;


class SearchService {

    public function oneStopFlights($from, $to, $date, $class, $seats) {

        $flights = [];
        $settings = AdminPanel::find(1);

        foreach (Flight::fromCity(City::find($from))
            ->forDate($date)
            ->havingSeats($class, $seats)
            ->get() as $flight_from) {

            if ($flight_from->to->id == $to) {
                $flights[] = [
                    'class' => $class,
                    'price' => $flight_from->priceForClass($class),
                    'stops' => [ $flight_from ],
                    'route' => route('flights.addtocart', [
                        'class' => $class,
                        'seats' => $seats,
                        'id'    => $flight_from->id
                    ])
                ];
            }
            else {
                foreach (Flight::fromCity($flight_from->to)
                    ->toCity(City::find($to))
                    ->fromDate($date)
                    ->havingSeats($class, $seats)
                    ->get() as $flight_to) {

                    $gap = $this->getGap($flight_from, $flight_to);
                    if ($gap < 0) { continue; }
                    if ($gap > $settings->max_gap) { continue; }
                    if ($this->getDuration($flight_from, $flight_to, $gap) > $settings->max_flight_duration) { continue; }
                    $flights[] = [ 
                        'class' => $class,
                        'price' => ($flight_from->priceForClass($class) + $flight_to->priceForClass($class)) 
                                    * (1 - $settings->percentage_stopover),
                        'stops' => [ $flight_from, $flight_to ],
                        'route' => route('flights.addtocart', [
                            'class' => $class,
                            'seats' => $seats,
                            'id'    => $flight_from->id,
                            'stop'  => $flight_to->id
                        ])
                    ];
                }
            }
        }
        usort($flights, function ($aFlight, $anotherFlight) {
            return $aFlight['price'] <=> $anotherFlight['price'];
        });
        return $flights;
    }


    private function getGap(Flight $from, Flight $to) {

        $from_dt = new Carbon("{$from->date->format('Y-m-d')} {$from->time}");
        $to_dt = new Carbon("{$to->date->format('Y-m-d')} {$to->time}");
        $from_dt->addMinutes($from->durationInMinutes());

        return $from_dt->diffInHours($to_dt, false);
    }


    private function getDuration(Flight $from, Flight $to, $gap) {

        return $gap + floor(($to->durationInMinutes() + $from->durationInMinutes()) / 60);
    }


    public function nonStopFlights($from, $to, $date, $class, $seats) {

        $flights = [];
        foreach (Flight::fromCity(City::find($from))
            ->toCity(City::find($to))
            ->forDate($date)
            ->havingSeats($class, $seats)
            ->get() as $flight) {

            $flights[] = [
                'class' => $class,
                'price' => $flight->priceForClass($class),
                'stops' => [ $flight ],
                'route' => route('flights.addtocart', [
                    'class' => $class,
                    'seats' => $seats,
                    'id'    => $flight->id
                ])
            ];
        }
        usort($flights, function ($aFlight, $anotherFlight) {
            return $aFlight['price'] <=> $anotherFlight['price'];
        });
        return $flights;
    }

public function rooms($city, $capacity, $from, $to, $amenities) {
    // $rooms = Room::join('hotels', 'hotels.id', '=', 'rooms.hotel_id')
    // ->where([['capacity', '>=', $capacity],['city_id', '=', $city],['rooms.from', '>=', $from]])->get()->all();
    // if(isset($amenities)){
    // return array_filter($rooms, function ($room) use ($amenities) {
    //     $roomAmenities = $room->hotel->amenities;
    //     foreach ($amenities as $amenity) {
    //         if (! in_array($amenity, $roomAmenities)) {
    //             return false;
    //         }
    //         return true;
    //     });}
    //     else{
    //         return $rooms;
    //     }
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
