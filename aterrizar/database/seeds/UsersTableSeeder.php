<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->truncate();
      //admin
      $role_user = '1';
      $user = new User();
      $user->name = 'Nico';
      $user->lastname = 'Urquiola';
      $user->email = 'nico@aterrizar.com';
      $user->password = bcrypt('123456');
      $user->save();
      $user->roles()->attach($role_user);
      //usuario comun
      $role_user = '2';
      $user = new User();
      $user->name = 'Franco';
      $user->lastname = 'Tagliero';
      $user->email = 'franco@aterrizar.com';
      $user->password = bcrypt('123456');
      $user->save();
      $user->roles()->attach($role_user);
      //usuario comercial
      $role_user = '3';
      $user = new User();
      $user->name = 'Joaquin';
      $user->lastname = 'Perez';
      $user->email = 'joaco@aterrizar.com';
      $user->password = bcrypt('123456');
      $user->save();
      $user->roles()->attach($role_user);
    }
}
