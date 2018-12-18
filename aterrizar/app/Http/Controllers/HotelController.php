<?php

namespace App\Http\Controllers;

use App\{Hotel, Transaction};
use Illuminate\Http\Request;
use App\Http\Requests\StoreRating;

class HotelController extends Controller
{
    
    public function show($id) {

        $hotel = Hotel::find($id);

        return view('hotels.show')->with('hotel', $hotel);
    }
}
