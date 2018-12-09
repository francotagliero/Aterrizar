<?php

use App\Airline;
use Illuminate\Database\Seeder;

class AirlinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('airlines')->truncate();
        $airlines = [ 
            ['name' => 'Aerolíneas Argentinas'],
            ['name' => 'LATAM Airlines'],
            ['name' => 'Avianca'],
            ['name' => 'Iberia'],
            ['name' => 'British Airways'],
            ['name' => 'American Airlines']
        ];
        foreach ($airlines as $airline) {
            Airline::create($airline);
        }
    }
}
