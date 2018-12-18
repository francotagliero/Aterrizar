<?php

namespace App\Http\Controllers;

use App\{Car, CarBrand, CarRentalAgency,City, Transaction};
use App\Http\Requests\{SearchCar, StoreCar};
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CarController extends Controller
{

    public function index(Request $request) {

        Auth::guest() or $request->user()->authorizeRoles(['user']);

        $cities = City::pluck('name', 'id');
        $car_brands = CarBrand::pluck('name','id');
        $car_brands->prepend('Cualquiera');
        $car_rental_agencies=CarRentalAgency::pluck('name','id')->toArray();
        $car_rental_agencies=array_unique($car_rental_agencies);
        $cars = $request->old('cars');
        if ($cars !== null) {
            // Keep search on refresh
            $request->session()->reflash();
            return view('cars.index')->with(compact('cities', 'car_brands','car_rental_agencies','cars'));
        }
        return view('cars.index')->with(compact('cities','car_brands','car_rental_agencies'));
    }
    
    
    public function create(Request $request) {

        $request->user()->authorizeRoles(['comercial']);

        $brands = CarBrand::pluck('name', 'id');
        $agencies = [];
        foreach (CarRentalAgency::all() as $agency) {
            $agencies[$agency->id] = "{$agency->name} - {$agency->city->name}";
        }
        $segments = [ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' => 'F' ];
        return view('cars.create')->with(compact('brands', 'agencies', 'segments'));
    }


    public function store(StoreCar $request) {

        $request->user()->authorizeRoles(['comercial']);

        $car = new Car();
        $car->brand()->associate(CarBrand::find($request->brand));
        $car->agency()->associate(CarRentalAgency::find($request->agency));
        $car->model = $request->model;
        $car->segment = $request->segment;
        $car->price = $request->price;
        $car->range = $request->range;
        $car->save();

        return back()->with('success', true);
    }

    public function search(SearchCar $request, SearchService $search) {

        Auth::guest() or $request->user()->authorizeRoles(['user']);

        $cars = $search->cars(
            $request->from,
            $request->to,
            $request->date_rent,
            $request->date_return,
            $request->brand,
            $request->agency
        );
        $input = $request->all();
        $input['cars'] = $cars;
        
        return back()->withInput($input);
    }

    public function show(Request $request, $id) {

        $request->user()->authorizeRoles(['user']);

        $car= Car::find($id);
        $agency = CarRentalAgency::find($car->agency_id);

        return view('cars.show')->with(compact('car', 'agency'));
    }

}
