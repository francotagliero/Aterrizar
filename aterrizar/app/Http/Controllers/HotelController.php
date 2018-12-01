<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    
    public function show($id) {

        $hotel = Hotel::find($id);

        return view('hotels.show')->with('hotel', $hotel);
    }
}
