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
      $role_user = Role::where('name', 'user')->first();
      $user = new User();
      $user->name = 'User';
      $user->lastname = 'User';
      $user->email = 'user@ate.com';
      $user->password = bcrypt('123456');
      $user->save();
      $user->roles()->attach($role_user);
    }
}
