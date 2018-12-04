<?php

use App\AdminPanel;
use Illuminate\Database\Seeder;

class AdminPanelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        DB::table('admin_panel')->truncate();
        $adminpanel = new AdminPanel();
        $adminpanel->max_flight_duration = 10;
        $adminpanel->max_gap = 2;
        $adminpanel->percentage_stopover = 0.50;
        $adminpanel->return_tax = 0.10;
       	$adminpanel->points_per_peso = 0.75;
       	$adminpanel->pesos_per_point = 0.5;
       	$adminpanel->firstclass_factor = 0.5;
       	$adminpanel->bussinessclass_factor = 0.25;
       	$adminpanel->save();
    }
}
