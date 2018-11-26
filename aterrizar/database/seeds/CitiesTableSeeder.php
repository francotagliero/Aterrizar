<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $cities = [ 
            ['name' => 'Buenos Aires', 
            'state' => 'Ciudad de Buenos Aires',
            'country' => 'Argentina',
            'code' =>  'BUE',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'Lisboa',
            'state' => 'Lisboa',
            'country' => 'Portugal',
            'code' =>  'LIS',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'Montevideo',
            'state' => 'Montevideo',
            'country' => 'Uruguay',
            'code' =>  'MVD',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'Madrid',
            'state' => 'Comunidad de Madrid',
            'country' => 'España',
            'code' =>  'MAD',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'París',
            'state' => 'Ile de France',
            'country' => 'Francia',
            'code' =>  'PAR',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'Berlín',
            'state' => 'Berlín',
            'country' => 'Alemania',
            'code' =>  'BER',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'Roma',
            'state' => 'Lazio',
            'country' => 'Italia',
            'code' =>  'ROM',
            'created_at' => $now,
            'updated_at' => $now]
        ];
        City::insert($cities);
    }
}
