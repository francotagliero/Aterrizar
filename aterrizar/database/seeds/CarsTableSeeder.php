<?php

use App\{Car, CarBrand, CarRentalAgency, City};
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {          
        DB::table('cars')->truncate();
        $buenosAires = City::where('name', 'Buenos Aires')->first()->id;
        $paris = City::where('name', 'París')->first()->id;
        $cars = [
            ['model' => 'Gol',
             'segment' => 'B',
             'price' => '1200',
             'range' => '500',
             'brand_id' => CarBrand::where('name', 'Volkswagen')->first()->id,
             'agency_id' => CarRentalAgency::where('name', 'Avis')->where('city_id', $buenosAires)->first()->id],
            ['model' => '308',
             'segment' => 'C',
             'price' => '1300',
             'range' => '600',
             'brand_id' => CarBrand::where('name', 'Peugeot')->first()->id,
             'agency_id' => CarRentalAgency::where('name', 'Hertz')->where('city_id', $paris)->first()->id],
              ['model' => 'TT',
             'segment' => 'A',
             'price' => '3000',
             'range' => '600',
             'brand_id' => CarBrand::where('name', 'Audi')->first()->id,
             'agency_id' => CarRentalAgency::where('name', 'Hertz')->where('city_id', $paris)->first()->id]
        ];
        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
