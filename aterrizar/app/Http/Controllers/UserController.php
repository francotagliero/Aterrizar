<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{  
    public function index() {
    	  $id = Auth::user()->id;
    	  $user=User::select('name','lastname','email','points')->where('id',$id)->first();
    	  return view('myProfile.index')->with('user',$user);
    }
}
