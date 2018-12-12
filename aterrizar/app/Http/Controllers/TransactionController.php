<?php

namespace App\Http\Controllers;

use App\{AdminPanel, Car, Flight, Transaction, Room};
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

    
    public function addFlightToCart(Request $request, $class, int $seats, $id, $stop = null) {

        $request->user()->authorizeRoles('user');

        $flight = Flight::find($id);
        foreach (range(1, $seats) as $iteration) {
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
        }
        $flight->decreaseCapacity($seats, $class);
        $flight->save();
        if ($stop !== null) {
            $stop->decreaseCapacity($seats, $class);
            $stop->save();
        }
        return redirect('myCart');
    }


    public function addCarToCart(Request $request, $id, $dateRent, $dateReturn, $returnCityId) {

        $request->user()->authorizeRoles('user');

        $car = Car::find($id);
        $transaction = new Transaction();
        $transaction->service()->associate($car);
        $transaction->user()->associate(Auth::user());
        $transaction->price = $car->priceForDates($dateRent, $dateReturn);
        $transaction->from = $dateRent;
        $transaction->to = $dateReturn;
        $transaction->extra = (int) $returnCityId;
        $transaction->points = $this->getPoints($transaction->price);
        $transaction->points_given = false;
        $transaction->save();

        return redirect('myCart');
    }
    
    
    public function addRoomToCart(Request $request, $id, $from, $to, $capacity) {

        $request->user()->authorizeRoles('user');

        $room = Room::find($id);
        $transaction = new Transaction();
        $transaction->service()->associate($room);
        $transaction->user()->associate(Auth::user());
        $transaction->price = $room->priceForDates($from, $to, $capacity);
        $transaction->from = $from;
        $transaction->to = $to;
        $transaction->extra = [ '' ];
        $transaction->points = $this->getPoints($transaction->price);
        $transaction->points_given = false;
        $transaction->save();
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


    public function removeFromCart(Request $request, $id) {

        $transaction = Transaction::find($id);
        if ($transaction->service->serviceType === 'Flight') {
            $flight = $transaction->service;
            $flight->increaseCapacity(1, $transaction->extra['class']);
            if (isset($transaction->extra['stop'])) {
                $stop = Flight::find($transaction->extra['stop']);
                $stop->increaseCapacity(1, $transaction->extra['class']);
                $stop->save();
            }
            $flight->save();
        }
        $transaction->delete();

        return redirect('myCart');        
    }

}
