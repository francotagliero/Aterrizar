<?php

namespace App\Http\Controllers;

use App\FlightSearch\FlightSearch;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FlightSearchController extends Controller
{
     public function filter(Request $request)
    {
	     return FlightSearch::apply($request);
	}
}
