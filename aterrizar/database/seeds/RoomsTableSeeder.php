<?php

use Illuminate\Database\Seeder;
use App\{Room,Hotel};
use Carbon\Carbon;



class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->truncate();
        $romaHotel= Hotel::where('name', 'Roma')->first()->id;
        $italiaHotel= Hotel::where('name', 'Italia')->first()->id;
        $sudestadaHotel= Hotel::where('name', 'Sudestada')->first()->id;
        $rooms = [
            ['hotel_id' => $romaHotel,
             'capacity' => 5,
             'from' => new Carbon('2018-03-19'),
             'to' => new Carbon('2018-03-30')],
             ['hotel_id' => $italiaHotel,
             'capacity' => 3,
             'from' => new Carbon('2018-03-19'),
             'to' => new Carbon('2018-03-30')],
             ['hotel_id' => $sudestadaHotel,
             'capacity' => 3,
             'from' => new Carbon('2018-03-20'),
             'to' => new Carbon('2018-03-25')],
             ];
         foreach ($rooms as $room) {
            Room::create($room);
        }



    }
}
