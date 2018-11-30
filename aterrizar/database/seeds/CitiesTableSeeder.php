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
        $cities = [ 
            ['name' => 'Buenos Aires', 
            'state' => 'Ciudad de Buenos Aires',
            'country' => 'Argentina',
            'code' =>  'BUE'],
            ['name' => 'Lisboa',
            'state' => 'Lisboa',
            'country' => 'Portugal',
            'code' =>  'LIS'],
            ['name' => 'Montevideo',
            'state' => 'Montevideo',
            'country' => 'Uruguay',
            'code' =>  'MVD'],
            ['name' => 'Madrid',
            'state' => 'Comunidad de Madrid',
            'country' => 'España',
            'code' =>  'MAD'],
            ['name' => 'París',
            'state' => 'Ile de France',
            'country' => 'Francia',
            'code' =>  'PAR'],
            ['name' => 'Berlín',
            'state' => 'Berlín',
            'country' => 'Alemania',
            'code' =>  'BER'],
            ['name' => 'Roma',
            'state' => 'Lazio',
            'country' => 'Italia',
            'code' =>  'ROM'],
            ['name' => 'Córdoba',
            'state' => 'Córdoba',
            'country' => 'Argentina',
            'code' =>  'COR']
        ];
        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
