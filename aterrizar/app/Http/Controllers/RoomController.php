<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{City, Hotel, Room};
use App\Http\Requests\StoreRoom;

class RoomController extends Controller
{
    
    public function index() {

        $rooms = Room::all();

        return view('rooms.index')->with('rooms', $rooms);
    }
    
    
    public function create() {

        $cities = City::pluck('name', 'id');
        $hotels = Hotel::pluck('name', 'id');

        return view('rooms.create')->with(compact('cities', 'hotels'));
    }


    public function store(StoreRoom $request) {

        $room = new Room();
        $room->city()->associate(City::find($request->city));
        $room->hotel()->associate(Hotel::find($request->hotel));
        $room->rooms = $request->rooms;
        $room->from = $request->from;
        $room->to = $request->to;
        $room->save();

        return redirect('rooms');
    }
}
