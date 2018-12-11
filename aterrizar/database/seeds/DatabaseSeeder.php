<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // La creación de datos de roles debe ejecutarse primero
      $this->call(RoleTableSeeder::class);
      // Los usuarios necesitarán los roles previamente generados
      $this->call(UsersTableSeeder::class);
    //   $this->call(AdminTableSeeder::class);
    //   $this->call(ComercialTableSeeder::class);
      $this->call(AirlinesTableSeeder::class);
      $this->call(CitiesTableSeeder::class);
      $this->call(HotelsTableSeeder::class);
      $this->call(CarBrandsTableSeeder::class);
      $this->call(CarRentalAgenciesTableSeeder::class);
      $this->call(CarsTableSeeder::class);
      $this->call(FlightsTableSeeder::class);
      $this->call(AdminPanelsTableSeeder::class);
      $this->call(RoomsTableSeeder::class);
      $this->call(TransactionsTableSeeder::class);
    }
}
