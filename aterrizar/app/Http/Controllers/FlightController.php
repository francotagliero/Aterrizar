<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\{City, Flight};
use App\Http\Requests\StoreFlight;

class FlightController extends Controller
{
    
    public function index() {

        $flights = Flight::all();

        return view('flights.index')->with('flights', $flights);
    }
    
    
    public function create() {

        $cities = City::pluck('name', 'id');
        return view('flights.create')->with(compact('cities'));
    }


    public function store(StoreFlight $request) {

        $flight = new Flight();
        $flight->from()->associate(City::find($request->from));
        $flight->to()->associate(City::find($request->to));
        $flight->date = $request->date;
        $flight->time = $request->time;
        $flight->duration = $request->duration;
        $flight->price = $request->price;
        $flight->economy_seats = $request->economy_seats;
        $flight->business_seats = $request->business_seats;
        $flight->first_class_seats = $request->first_class_seats;
        $flight->save();

        return redirect('flights');
    }
}
