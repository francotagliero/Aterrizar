<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfile;
use App\Services\TransactionService;
use App\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{  
    public function __construct() {
        
        $this->middleware('auth');
    }
    
    public function index(Request $request, TransactionService $transactionService) {

        $transactionService->consumeTransactions($request->user());
        
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
