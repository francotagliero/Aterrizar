<?php

use App\{Airline, City, Flight};
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FlightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   DB::table('flights')->truncate();
        $buenosAires = City::where('name', 'Buenos Aires')->first()->id;
        $montevideo = City::where('name', 'Montevideo')->first()->id;
        $lisboa = City::where('name', 'Lisboa')->first()->id;
        $madrid = City::where('name', 'Madrid')->first()->id;
        $iberia = Airline::where('name', 'Iberia')->first()->id;
        $aerolineas = Airline::where('name', 'Aerolíneas Argentinas')->first()->id;
        $avianca = Airline::where('name', 'Avianca')->first()->id;
        $british = Airline::where('name', 'British Airways')->first()->id;
        $flights = [
            ['airline_id' => $iberia,
             'city_from' => $buenosAires,
             'city_to' => $lisboa,
             'date' => new Carbon('2018-01-10'),
             'time' => '13:00',
             'duration' => '14:00',
             'price' => 30000,
             'economy_seats' => 100,
             'business_seats' => 20,
             'first_class_seats' => 10],
            ['airline_id' => $aerolineas,
             'city_from' => $buenosAires,
             'city_to' => $montevideo,
             'date' => new Carbon('2018-01-10'),
             'time' => '13:00',
             'duration' => '02:00',
             'price' => 2000,
             'economy_seats' => 50,
             'business_seats' => 10,
             'first_class_seats' => 0],
            ['airline_id' => $iberia,
             'city_from' => $montevideo,
             'city_to' => $lisboa,
             'date' => new Carbon('2018-01-10'),
             'time' => '13:00',
             'duration' => '02:00',
             'price' => 28000,
             'economy_seats' => 90,
             'business_seats' => 10,
             'first_class_seats' => 10],
            ['airline_id' => $iberia,
             'city_from' => $montevideo,
             'city_to' => $lisboa,
             'date' => new Carbon('2018-01-10'),
             'time' => '19:00',
             'duration' => '12:00',
             'price' => 28000,
             'economy_seats' => 90,
             'business_seats' => 10,
             'first_class_seats' => 10],
            ['airline_id' => $iberia,
             'city_from' => $lisboa,
             'city_to' => $madrid,
             'date' => new Carbon('2018-01-11'),
             'time' => '04:00',
             'duration' => '03:00',
             'price' => 5800,
             'economy_seats' => 50,
             'business_seats' => 10,
             'first_class_seats' => 20],
            ['airline_id' => $iberia,
             'city_from' => $lisboa,
             'city_to' => $madrid,
             'date' => new Carbon('2018-01-11'),
             'time' => '08:00',
             'duration' => '03:00',
             'price' => 6500,
             'economy_seats' => 50,
             'business_seats' => 10,
             'first_class_seats' => 20],
            ['airline_id' => $iberia,
             'city_from' => $buenosAires,
             'city_to' => $madrid,
             'date' => new Carbon('2018-04-15'),
             'time' => '05:00',
             'duration' => '13:00',
             'price' => 25000,
             'economy_seats' => 10,
             'business_seats' => 0,
             'first_class_seats' => 0],
            ['airline_id' => $avianca,
             'city_from' => $buenosAires,
             'city_to' => $madrid,
             'date' => new Carbon('2018-04-15'),
             'time' => '07:00',
             'duration' => '14:00',
             'price' => 19000,
             'economy_seats' => 20,
             'business_seats' => 20,
             'first_class_seats' => 22],
            ['airline_id' => $british,
             'city_from' => $buenosAires,
             'city_to' => $madrid,
             'date' => new Carbon('2018-04-15'),
             'time' => '12:00',
             'duration' => '18:00',
             'price' => 22000,
             'economy_seats' => 15,
             'business_seats' => 18,
             'first_class_seats' => 13],
        ];
        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }
}
