<?php

use App\Airline;
use Illuminate\Database\Seeder;

class AirlineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $airlines = [ 
            ['name' => 'Aerolíneas Argentinas',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'LATAM Airlines',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'Avianca',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'Iberia',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'British Airways',
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'American Airlines',
            'created_at' => $now,
            'updated_at' => $now]
        ];
        Airline::insert($airlines);
    }
}
