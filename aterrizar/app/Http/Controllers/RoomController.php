<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\{City, Hotel, Room, Transaction};
use App\Http\Requests\{SearchRoom, StoreRoom};
use App\Services\SearchService;


class RoomController extends Controller
{

public function array_flatten($array) { 
    if (!is_array($array)) { 
        return false; 
    } 
    $result = array(); 
    foreach ($array as $key => $value) { 
        if (is_array($value)) { 
          $result = array_merge($result, array_flatten($value)); 
    } else { 
          $result[$key] = $value; 
    } 
    } 
    return $result; 
}    


public function index(Request $request) {

    $cities = City::pluck('name', 'id');
    $hotel = Hotel::all();
    $amenities= Hotel::select('amenities')->get();
    $amenities = (array) json_decode($amenities, true);
    $amenities = $this->array_flatten($amenities);
    $final= array_unique($amenities);
    $final=array_combine($final, $final);
    

    $rooms = $request->old('rooms');
    if ($rooms !== null) {
            // Keep search on refresh
        $request->session()->reflash();
        return view('rooms.index')->with(compact('rooms', 'cities','final'));
    }
    return view('rooms.index')->with(compact('cities','final'));
}

public function create() {

    $hotels = [];
    foreach (Hotel::all() as $hotel) {
        $hotels[$hotel->id] = "{$hotel->name} - {$hotel->city->name}";
    }
    return view('rooms.create')->with(compact('hotels'));
}


public function store(StoreRoom $request) {

    $room = new Room();
    $room->hotel()->associate(Hotel::find($request->hotel));
    $room->capacity = $request->capacity;
    $room->from = $request->from;
    $room->to = $request->to;
    $room->save();

    return back()->with('success', true);
}

public function search(SearchRoom $request, SearchService $search) {

    $rooms = $search->rooms(
        $request->city,
        $request->capacity,
        $request->from,
        $request->to,
        $request->amenities
        );
    $input = $request->all();
    $input['rooms'] = $rooms;

    return back()->withInput($input);
}

public function show($id_transaction) {

        $transaction=Transaction::find($id_transaction);
        
        $room = Room::find($transaction->service_id);
        
        $hotel = Hotel::find($room->hotel_id);

        return view('rooms.show')->with(compact('hotel', 'transaction', 'room'));
}
}
