<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProfile;

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

    public function create() {

        return view('myprofile.create');
    } 


       public function store(StoreProfile $request) {

        $id = Auth::user()->id;
        $dni= $request->dni;
        $username= $request->username;
        User::where('id', $id)->update(['dni'=>$dni, 'username'=>$username]);

        return redirect('myprofile');
    }
}
