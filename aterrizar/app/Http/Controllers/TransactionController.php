<?php

namespace App\Http\Controllers;

use App\{AdminPanel, Flight, Transaction};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function __construct() {
        
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $transactions = Transaction::all();

        return view('transactions.index')->with('transactions', $transactions);
    }

    public function myCart(Request $request)
    {
        $request->user()->authorizeRoles('user');

        $transactions = Transaction::forLoggedUser()->inCart()->get();
        return view('myCart.index')->with('transactions', $transactions);
    }

    
    public function addFlightToCart(Request $request, $class, $seats, $id, $stop = null) {

        $request->user()->authorizeRoles('user');

        $flight = Flight::find($id);
        while ($seats) {
            $transaction = new Transaction();
            $transaction->service()->associate($flight);
            $transaction->user()->associate(Auth::user());
            $transaction->price = $flight->priceForClass($class);
            $transaction->from = $flight->date;
            $transaction->to = $flight->date;
            $transaction->extra = [ 'class' => $class ];
            if ($stop !== null) {
                $stop = Flight::find($stop);
                $transaction->price = ($transaction->price + $stop->priceForClass($class)) 
                                    * (1 - AdminPanel::find(1)->percentage_stopover);
                $transaction->extra = array_merge($transaction->extra, ['stop' => $stop->id]);
            }
            $transaction->points = $this->getPoints($transaction->price);
            $transaction->points_given = false;
            $transaction->save();
            $seats--;
        }
        return redirect('myCart');
    }


    private function getPoints($price) {

        return floor($price * AdminPanel::find(1)->points_per_peso);
    }


    public function completeTransaction($idTransaction)
    {
      //falta chequear la tarjeta y los puntos
      $transaction = Transaction::where('id', '=', $idTransaction)->update(['status' => 'Comprado']);
      return $this->myShopping();
    }

    public function myShopping(Request $request)
    {
        $request->user()->authorizeRoles('user');

        $transactions = Transaction::forLoggedUser()->bought()->get();
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
