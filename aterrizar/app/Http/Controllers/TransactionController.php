<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Flight;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $transactions = Transaction::all();

        return view('transactions.index')->with('transactions', $transactions);
    }

    public function myCart()
    {
      $transactions = Transaction::where([
                                         ['status', '=', 'En Carrito'],
                                         ['user_id', '=', Auth::user()->id],
                                        ])->get();
      return view('myCart.index')->with('transactions', $transactions);
      }

    public function addFlightToCart($flightId)
    {
      $flight = Flight::where('id', '=', $flightId)->get();
      //dd($flight);
      //$transaction = new Transaction();
      echo $flight->getId();
      //$transaction->service_name = $flight->
      //$transaction->service_id = $request->service_id;
      //$transaction->user_id = $request->user_id;
      //$transaction->points = $request->points;
      //$transaction->points_given = 'false';
      //$transaction->price = $request->price;
      //$transaction->status = 'En Carrito';
      //$transaction->save();
    }

    public function myShopping()
    {
      $transactions = Transaction::where([
                                         ['status', '<>', 'En Carrito'],
                                         ['user_id', '=', Auth::user()->id],
                                        ])->get();
      return view('myShopping.index')->with('transactions', $transactions);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaction $request) {

        $transaction = new Transaction();
        $transaction->service_name = $request->service_name; //deberia pasarse como parametro
        $transaction->service_id = $request->service_id;
        $transaction->user_id = $request->user_id;
        $transaction->points = $request->points;
        $transaction->points_given = 'false';
        $transaction->price = $request->price;
        //$transaction->status = 'En Carrito';
        $transaction->save();
        return redirect('transactions');
    }

}
