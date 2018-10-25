<?php

use App\Comercial;
use App\Role;
use Illuminate\Database\Seeder;

class ComercialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_comercial = Role::where('name', 'comercial')->first();
      $user = new Comercial();
      $user->name = 'Comercial';
      $user->dni = '40123457';
      $user->email = 'comercials1@ate.com';
      $user->password = bcrypt('123456');
      $user->save();
      $user->roles()->attach($role_comercial);
    }
}
