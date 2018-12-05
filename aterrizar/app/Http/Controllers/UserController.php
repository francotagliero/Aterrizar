<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{  
    public function index() {
    	  $id = Auth::user()->id;
    	  $role= Auth::user()->roles;
    	  $role=$role[0]->name;
    	  if($role=="user"){
    	  $user=User::select('name','lastname','email','points')->where('id',$id)->first();
    	  return view('myProfile.index')->with('user',$user);
    	  }
    	  else{
    	  	$user=User::select('name','lastname','email','dni','username')->where('id',$id)->first();
    	  	return view('myProfile.index')->with('user',$user);
    	  }
    }

    public function update(){
    	return view('myProfile.update');
    }
}
