<?php

namespace App\Http\Controllers;

use App\RegistrableUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Role;
use App\Http\Requests\StoreRegistrableUser;



class RegistrableUserController extends Controller
{
    public function __construct() {
        
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles('admin');

         $registrableUser = RegistrableUser::all();

        return view('registrableUser.index')->with('registrableUser', $registrableUser);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles('admin');

        $roles = Role::registrable()->get()->pluck('description', 'id');
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
        $request->user()->authorizeRoles('admin');

        $registrableUser = new RegistrableUser();
        $registrableUser->email= $request->email;
        $registrableUser->role()->associate(Role::find($request->role));
        $registrableUser->save();

        return redirect('givenregistration');
    }
     
}
