<?php

use App\{CarRentalAgency, City};
use Illuminate\Database\Seeder;

class CarRentalAgenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('car_rental_agencies')->truncate();
        $agencies = [ 
            ['name' => 'Avis',
            'address' => 'Santa Fe 1300',
            'city_id' => City::where('name', 'Buenos Aires')->first()->id,
            'ratings' => 119,
            'votes' =>  25],
            ['name' => 'Avis',
            'address' => 'Jujuy 248',
            'city_id' => City::where('name', 'Córdoba')->first()->id,
            'ratings' => 93,
            'votes' =>  20],
            ['name' => 'Avis',
            'address' => 'Uruguay 1417',
            'city_id' => City::where('name', 'Montevideo')->first()->id,
            'ratings' => 100,
            'votes' =>  24],
            ['name' => 'Avis',
            'address' => 'Av Praia Da Vitoria',
            'city_id' => City::where('name', 'Lisboa')->first()->id,
            'ratings' => 103,
            'votes' =>  22],
            ['name' => 'Avis',
            'address' => 'Gran Via 46',
            'city_id' => City::where('name', 'Madrid')->first()->id,
            'ratings' => 30,
            'votes' =>  10],
            ['name' => 'Hertz',
            'address' => 'Tomas Breton 8-10',
            'city_id' => City::where('name', 'Madrid')->first()->id,
            'ratings' => 30,
            'votes' =>  9],
            ['name' => 'Hertz',
            'address' => 'Paraguay 1138',
            'city_id' => City::where('name', 'Buenos Aires')->first()->id,
            'ratings' => 20,
            'votes' =>  5],
            ['name' => 'Hertz',
            'address' => 'Budapester 39',
            'city_id' => City::where('name', 'Berlín')->first()->id,
            'ratings' => 200,
            'votes' =>  43],
            ['name' => 'Avis',
            'address' => 'Rue de Lourmel 105',
            'city_id' => City::where('name', 'Paris')->first()->id,
            'ratings' => 190,
            'votes' =>  40]
        ];
        foreach ($agencies as $agency) {
            CarRentalAgency::create($agency);
        }
    }
}
