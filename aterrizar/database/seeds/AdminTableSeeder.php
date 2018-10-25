<?php

use App\Role;
use App\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $admin = new Admin();
        $admin->name = 'Admin';
        $admin->email = 'admin@ate.com';
        $admin->password = bcrypt('123456');
        $admin->dni = '40123123';
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
