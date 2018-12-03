<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use App\Transaction;


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
