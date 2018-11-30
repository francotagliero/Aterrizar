<?php

use Illuminate\Database\Seeder;
use App\{City, Hotel};

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotels = [ 
            ['name' => 'Roma',
            'city_id' => City::where('name', 'Buenos Aires')->first()->id,
            'price' => 450,
            'ratings' => 14,
            'votes' =>  3,
            'stars' => 3,
            'amenities' => 'TV, Wi-Fi, Desayuno'],
            ['name' => 'Italia',
            'city_id' => City::where('name', 'Buenos Aires')->first()->id,
            'price' => 600,
            'ratings' => 119,
            'votes' =>  20,
            'stars' => 3,
            'amenities' => 'TV, Wi-Fi, Desayuno, Gimnasio'],
            ['name' => 'Sudestada',
            'city_id' => City::where('name', 'Montevideo')->first()->id,
            'price' => 200,
            'ratings' => 93,
            'votes' =>  11,
            'stars' => 2,
            'amenities' => 'TV, Desayuno'],
        ];
        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
