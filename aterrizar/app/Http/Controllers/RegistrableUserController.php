<?php

namespace App\Http\Controllers;

use App\RegistrableUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Role;
use App\Http\Requests\StoreRegistrableUser;



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
        $roles = Role::pluck('name', 'id');
        return view('registrableUser.create')->with(compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegistrableUser $request)
    {
        $registrableUser = new RegistrableUser();
        $registrableUser->email= $request->email;
        $registrableUser->role()->associate(Role::find($request->roles));
        $registrableUser->save();

        return redirect('givenregistration');
    }
     
}
