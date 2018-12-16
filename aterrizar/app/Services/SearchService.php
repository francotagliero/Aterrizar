<?php

namespace App\Services;

use App\{AdminPanel, Car, City, Flight, Room, CarRentalAgency, CarBrand, Hotel};
use Carbon\Carbon;
use \Datetime;
use DB;



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
    $days=$this->getDaysDifference($from,$to);
    $rooms= DB::select("select rooms.*, hotels.* from rooms inner join 
        hotels on hotels.id = rooms.hotel_id where (capacity >= $capacity and 
            city_id = $city and rooms.from <= '$from' and rooms.to >= '$to') 
    and not exists (select * from transactions where transactions.status<>'Cancelado' and rooms.id = 
        transactions.service_id and service_type like '%Room' and 
        (transactions.from < '$to' and transactions.to > '$from') )");
    foreach ($rooms as &$room) {
        $room->hotel=Hotel::find($room->hotel_id);
    }
    if(isset($amenities)){
        return array_filter($rooms, function ($room) use ($amenities) {
            $roomAmenities = $room->hotel->amenities;
            foreach ($amenities as $amenity) {
                if (! in_array($amenity, $roomAmenities)) {
                    return false;
                }
            }
            return true;
        });}
        else{
            return $rooms;
        }
    }

public function cars($from, $to, $date_rent, $date_return, $brand, $agency) {

    $days=$this->getDaysDifference($date_rent,$date_return);
    $agencyId=$this->getAgencyIdByCity($from,$agency);
            if(! empty($agencyId))
                {$agencyId=($agencyId['0'])['id'];}
            else
                return false;

    $differentCity = DB::select("select service_id from transactions inner join cars on 
    service_id = cars.id and service_type like '%Car' inner join car_rental_agencies 
    on cars.agency_id = car_rental_agencies.id where car_rental_agencies.city_id  <> 
    extra and transactions.to = '$date_rent'");
    
    $arrayServices=[];
        
    if(! empty($differentCity)){
        foreach ($differentCity as $diff){
            $arrayServices[]=$diff->service_id;
        }
    }

    if($brand == '0'){
       $cars= DB::select("select cars.* from cars where (agency_id = $agencyId) 
       and not exists (select * from transactions where cars.id = 
       transactions.service_id and service_type like '%Car' and
       (transactions.from < '$date_return' and transactions.to > '$date_rent'))");
    }
    else{    
       $cars= DB::select("select cars.* from cars where (agency_id = $agencyId and brand_id = $brand) 
       and not exists (select * from transactions where cars.id = 
       transactions.service_id and service_type like '%Car' and
       (transactions.from < '$date_return' and transactions.to > '$date_rent'))");
    }
    $pos=0;
    foreach ($cars as &$car) {
        if(in_array($car->id, $arrayServices)){
            unset($cars[$pos]);
            $pos=$pos+1;
        } 
        else{   
            $car->price=$car->price*$days;
            $car->brand=CarBrand::find($car->brand_id);
            $car->agency=CarRentalAgency::find($car->agency_id);
        }    
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
