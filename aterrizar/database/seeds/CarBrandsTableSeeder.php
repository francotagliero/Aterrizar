<?php

use App\CarBrand;
use Illuminate\Database\Seeder;

class CarBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [ 
            ['name' => 'Audi'],
            ['name' => 'BMW'],
            ['name' => 'Chevrolet'],
            ['name' => 'Citroën'],
            ['name' => 'Fiat'],
            ['name' => 'Ford'],
            ['name' => 'Mercedes-Benz'],
            ['name' => 'Peugeot'],
            ['name' => 'Toyota'],
            ['name' => 'Volkswagen']
        ];
        foreach ($brands as $brand) {
            CarBrand::create($brand);
        }
    }
}
