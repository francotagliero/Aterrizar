<?php

namespace App\Http\Controllers;

use App\{AdminPanel, Car, Flight, FlightTransactionDetail, Transaction, Room};
use App\Services\TransactionService;
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
            $detail = new FlightTransactionDetail();
            $detail->class = $class;
            if ($stop !== null) {
                $stop = Flight::find($stop);
                $transaction->price = ($transaction->price + $stop->priceForClass($class)) 
                                    * (1 - AdminPanel::find(1)->percentage_stopover);
                $detail->stop()->associate($stop);
            }
            $detail->save();
            $transaction->detail()->associate($detail);
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


    public function removeFromCart(TransactionService $transactionService, $id) {

        $transaction = Transaction::findOrFail($id);
        $transactionService->removeFromCart($transaction);

        return redirect('myCart');        
    }


    public function clearCart(TransactionService $transactionService) {

        $transactionService->clearCart(Auth::user());

        return redirect('myCart');        
    }
}
