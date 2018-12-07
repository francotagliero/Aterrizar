<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\{City, Hotel, Room};
use App\Http\Requests\{SearchRoom, StoreRoom};
use App\Services\SearchService;


class RoomController extends Controller
{
    
    public function index(Request $request) {

        $cities = City::pluck('name', 'id');

        $amenities= Hotel::select('amenities')->get();
        $final=[]; 
        foreach ($amenities as $amenitie) {
                $temp=explode(", ",$amenitie['amenities']);
                $final= array_merge($final, $temp);
            }
            $final=array_unique($final);

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
        $room->rooms = $request->rooms;
        $room->from = $request->from;
        $room->to = $request->to;
        $room->save();

        return redirect('rooms');
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
}
