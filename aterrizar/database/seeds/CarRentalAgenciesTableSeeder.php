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
        $agencies = [ 
            ['name' => 'Avis',
            'address' => 'Cerrito 1535',
            'city_id' => City::where('name', 'Buenos Aires')->first()->id,
            'ratings' => 119,
            'votes' =>  20],
            ['name' => 'Avis',
            'address' => 'Jujuy 248',
            'city_id' => City::where('name', 'Córdoba')->first()->id,
            'ratings' => 93,
            'votes' =>  11],
            ['name' => 'Avis',
            'address' => 'Uruguay 1417',
            'city_id' => City::where('name', 'Montevideo')->first()->id,
            'ratings' => 193,
            'votes' =>  24],
            ['name' => 'Avis',
            'address' => 'Av Praia Da Vitoria',
            'city_id' => City::where('name', 'Lisboa')->first()->id,
            'ratings' => 103,
            'votes' =>  12],
            ['name' => 'Avis',
            'address' => 'Gran Via 46',
            'city_id' => City::where('name', 'Madrid')->first()->id,
            'ratings' => 293,
            'votes' =>  36],
            ['name' => 'Hertz',
            'address' => 'Tomas Breton 8-10',
            'city_id' => City::where('name', 'Madrid')->first()->id,
            'ratings' => 80,
            'votes' =>  9],
            ['name' => 'Hertz',
            'address' => 'Paraguay 1138',
            'city_id' => City::where('name', 'Buenos Aires')->first()->id,
            'ratings' => 25,
            'votes' =>  3],
            ['name' => 'Hertz',
            'address' => 'Budapester 39',
            'city_id' => City::where('name', 'Berlín')->first()->id,
            'ratings' => 300,
            'votes' =>  43],
        ];
        foreach ($agencies as $agency) {
            CarRentalAgency::create($agency);
        }
    }
}
