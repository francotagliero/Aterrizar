<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComercialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:comercial');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('comercial');
    }
}
