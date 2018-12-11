<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\{Airline, City, Flight};
use App\Http\Requests\{SearchFlight, StoreFlight};
use App\Services\SearchService;

class FlightController extends Controller
{
    
    public function index(Request $request) {

        $cities = City::pluck('name', 'id');

        $flights = $request->old('flights');
        if ($flights !== null) {
            // Keep search on refresh
            $request->session()->reflash();
            return view('flights.index')->with(compact('cities', 'flights'));
        }
        return view('flights.index')->with(compact('cities'));
    }
    
    
    public function create() {

        $cities = City::pluck('name', 'id');
        $airlines = Airline::pluck('name', 'id');
        return view('flights.create')->with(compact('cities', 'airlines'));
    }


    public function store(StoreFlight $request) {

        $flight = new Flight();
        $flight->from()->associate(City::find($request->from));
        $flight->to()->associate(City::find($request->to));
        $flight->date = $request->date;
        $flight->time = $request->time;
        $flight->duration = $request->duration;
        $flight->price = $request->price;
        $flight->airline()->associate(Airline::find($request->airline));
        $flight->economy_seats = $request->economy_seats;
        $flight->business_seats = $request->business_seats;
        $flight->first_class_seats = $request->first_class_seats;
        $flight->save();

        return redirect('flights');
    }


    public function search(SearchFlight $request, SearchService $search) {

        if ($request->non_stop) {
            $flights = $search->nonStopFlights(
                $request->from,
                $request->to,
                $request->date,
                $request->class,
                $request->seats
            );
        }
        else {
            $flights = $search->oneStopFlights(
                $request->from,
                $request->to,
                $request->date,
                $request->class,
                $request->seats
            );
        }
        $input = $request->all();
        $input['flights'] = $flights;
        
        return back()->withInput($input);
    }
    

    public function show($id) {

        $flight = Flight::findOrFail($id);

        return view('flights.show')->with('flight', $flight);
    }
}
