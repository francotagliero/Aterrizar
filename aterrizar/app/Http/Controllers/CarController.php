<?php

namespace App\Http\Controllers;

use App\{Car, CarBrand, CarRentalAgency};
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index() {

        $cars = Car::all();

        return view('cars.index')->with('cars', $cars);
    }
    
    
    public function create() {

        $brands = CarBrand::pluck('name', 'id');
        $agencies = [];
        foreach (CarRentalAgency::all() as $agency) {
            $agencies[$agency->id] = "{$agency->name} - {$agency->city->name}";
        }
        $segments = [ 'A', 'B', 'C', 'D', 'E', 'F' ];
        return view('cars.create')->with(compact('brands', 'agencies', 'segments'));
    }


    public function store(StoreCar $request) {

        $car = new Car();
        $car->brand()->associate(CarBrand::find($request->brand));
        $car->agency()->associate(CarRentalAgency::find($request->agency));
        $car->model = $request->model;
        $car->segment = $request->segment;
        $car->price = $request->price;
        $car->range = $request->range;
        $flight->save();

        return redirect('cars');
    }
}
