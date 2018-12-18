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
        DB::table('hotels')->truncate();
        $hotels = [ 
            ['name' => 'Roma',
            'city_id' => City::where('name', 'Roma')->first()->id,
            'price' => 450,
            'ratings' => 14,
            'votes' =>  3,
            'stars' => 3,
            'amenities' => ['TV', 'Wi-Fi', 'Desayuno']],
            ['name' => 'Italia',
            'city_id' => City::where('name', 'Roma')->first()->id,
            'price' => 600,
            'ratings' => 9,
            'votes' =>  3,
            'stars' => 3,
            'amenities' => ['TV', 'Wi-Fi', 'Desayuno', 'Gimnasio']],
            ['name' => 'Sudestada',
            'city_id' => City::where('name', 'Paris')->first()->id,
            'price' => 200,
            'ratings' => 8,
            'votes' =>  2,
            'stars' => 2,
            'amenities' => ['TV', 'Desayuno']],
        ];
        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
