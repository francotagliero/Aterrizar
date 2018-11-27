<?php

use Illuminate\Database\Seeder;
use App\Hotel;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $hotels = [ 
            ['name' => 'Roma', 
            'price' => 450,
            'ratings' => 14,
            'votes' =>  3,
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'Italia',
            'price' => 600,
            'ratings' => 119,
            'votes' =>  20,
            'created_at' => $now,
            'updated_at' => $now],
            ['name' => 'Sudestada',
            'price' => 200,
            'ratings' => 93,
            'votes' =>  11,
            'created_at' => $now,
            'updated_at' => $now],
        ];
        Hotel::insert($hotels);
    }
}
