<?php

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
      DB::table('users')->insert([
        ['name' => str_random(10), 'lastname' => str_random(10), 'email' => 'ftagliero@gmail.com', 'password' => bcrypt('123456')],
        ['name' => str_random(10), 'lastname' => str_random(10), 'email' => 'pepe@gmail.com', 'password' => bcrypt('123456')]
      ]);
    }
}
