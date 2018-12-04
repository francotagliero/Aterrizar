<?php

namespace App\Http\Controllers;

use App\RegistrableUser;
use Illuminate\Http\Request;

class RegistrableUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $registrableUser = RegistrableUser::all();

        return view('registrableUser.index')->with('registrableUser', $registrableUser);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegistrableUser  $registrableUser
     * @return \Illuminate\Http\Response
     */
}
