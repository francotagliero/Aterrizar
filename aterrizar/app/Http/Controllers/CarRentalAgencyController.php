<?php

namespace App\Http\Controllers;

use App\CarRentalAgency;
use Illuminate\Http\Request;

class CarRentalAgencyController extends Controller
{
    
    public function show($id) {

        $agency = CarRentalAgency::find($id);

        return view('agencies.show')->with('agency', $agency);
    }
}
