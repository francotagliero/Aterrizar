<?php

use Illuminate\Database\Seeder;
use App\Transaction;
use App\Car;
use App\City;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('transactions')->truncate();
    	$transactions = new Transaction();
    	$volkswagen= Car::where('model', 'Gol')->first()->id;
    	$peugeot= Car::where('model', '308')->first()->id;
    	$montevideo = City::where('name', 'Montevideo')->first()->id;
    	$berlin = City::where('name', 'Berlin')->first()->id;
    	$transactions = [
    	['service_type' => 'App\Car',
    	'service_id' => $volkswagen,
    	'user_id' => '1',
    	'points' => '0',
    	'points_given' => '0',
    	'price' => '0',
    	'status' => 'Comprado',
    	'from' => '2018/03/20',
    	'to' => '2018/03/25',
    	'extra' => [ 'return_city_id' => $montevideo ]
    	],
    	['service_type' => 'App\Car',
    	'service_id' => $peugeot,
    	'user_id' => '1',
    	'points' => '0',
    	'points_given' => '0',
    	'price' => '0',
    	'status' => 'Comprado',
    	'from' => '2018/10/10',
    	'to' => '2018/10/13',
    	'extra' => [ 'return_city_id' => $berlin ]
    	],
    	];
    	foreach ($transactions as $transaction) {
    		Transaction::create($transaction);
    	}
    }
}

