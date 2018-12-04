<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StoreFlight;

class RoleController extends Controller
{
    
    public function index() {

        $roles = Role::all();

        return view('roles.index')->with('roles', $roles);
    }
    
    
    public function create() {

    }


    public function store(Request $request) {
    }
}