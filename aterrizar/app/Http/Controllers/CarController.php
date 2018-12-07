<?php

namespace App\Http\Controllers;

use App\{Car, CarBrand, CarRentalAgency,City};
use Illuminate\Http\Request;
use App\Http\Requests\{SearchCar, StoreCar};
use App\Services\SearchService;


class CarController extends Controller
{
    public function index(Request $request) {
        $cities = City::pluck('name', 'id');
        $car_brands = CarBrand::pluck('name','id');
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
    
    
    public function create() {

        $brands = CarBrand::pluck('name', 'id');
        $agencies = [];
        foreach (CarRentalAgency::all() as $agency) {
            $agencies[$agency->id] = "{$agency->name} - {$agency->city->name}";
        }
        $segments = [ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' => 'F' ];
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
        $car->save();

        return redirect('cars');
    }

    public function search(SearchCar $request, SearchService $search) {

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

}
