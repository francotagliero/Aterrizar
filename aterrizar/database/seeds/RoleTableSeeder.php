<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->truncate();
      $role = new Role();
      $role->name = 'admin';
      $role->description = 'Administrator';
      $role->save();

      $role = new Role();
      $role->name = 'user';
      $role->description = 'User';
      $role->save();

      $role = new Role();
      $role->name = 'comercial';
      $role->description = 'Comercial';
      $role->save();
    }
}
