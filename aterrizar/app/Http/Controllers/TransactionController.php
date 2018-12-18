<?php

namespace App\Http\Controllers;

use App\{AdminPanel, Car, Flight, FlightTransactionDetail, Transaction, Room};
use App\Http\Requests\Checkout;
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
        for($i=1; $i<$seats; $i++) {
            $duplicate = $transaction->replicate();
            $duplicate->push();
        }
        $flight->decreaseCapacity($seats, $class);
        $flight->save();
        if ($stop !== null) {
            $stop->decreaseCapacity($seats, $class);
            $stop->save();
        }
        $this->updateInCartSessionValue();

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
        $this->updateInCartSessionValue();

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
        $this->updateInCartSessionValue();

        return redirect('myCart');
    }


    private function getPoints($price) {
        return floor((int)$price * AdminPanel::find(1)->pesos_per_point);
    }


    public function myShopping(Request $request, TransactionService $transactionService)
    {
        $request->user()->authorizeRoles('user');

        $transactionService->consumeTransactions($request->user());

        $transactions = Transaction::forLoggedUser()->notInCart()->orderBy('created_at', 'DESC')->get();
        return view('myShopping.index')->with('transactions', $transactions);
    }


    public function removeFromCart(Request $request, TransactionService $transactionService, $id) {

        $request->user()->authorizeRoles('user');

        $transaction = Transaction::where('id', $id)->inCart()->firstOrFail();
        $transactionService->removeFromCart($transaction);
        $this->updateInCartSessionValue();

        return redirect('myCart')->with('deleted', true);
    }


    public function clearCart(Request $request, TransactionService $transactionService) {

        $request->user()->authorizeRoles('user');

        $transactionService->clearCart(Auth::user());
        $this->updateInCartSessionValue();

        return redirect('myCart');
    }


    public function checkout(Request $request, TransactionService $transactionService) {

        $request->user()->authorizeRoles('user');

        $transactionService->consumeTransactions($request->user());

        $transactions = Transaction::forLoggedUser()->inCart()->get();
        $total = 0;
        foreach ($transactions as $transaction) {
            $total += $transaction->price;
        }
        $availablePoints = Auth::user()->points;
        $pesos_per_point = AdminPanel::find(1)->pesos_per_point;

        return view('myCart.checkout')->with(compact('transactions', 'total', 'availablePoints', 'pesos_per_point'));
    }


    public function confirmCheckout(Checkout $request) {

        $request->user()->authorizeRoles('user');
        
        // Validate correctness of input against database
        // 1. Points
        if ($request->points > $request->user()->points) {
            return $this->checkoutError();
        }
        $transactions = Transaction::forLoggedUser()->inCart()->get();
        // 2. Total
        $total = 0;
        foreach ($transactions as $transaction) {
            $total += $transaction->price;
        }
        if ($request->total != number_format($total, 2, ',', '.')) {
            return $this->checkoutError();
        }
        // 3. Discount
        $discount = $request->points * AdminPanel::find(1)->pesos_per_point;
        if ($request->discount != number_format($discount, 2, ',', '.')) {
            return $this->checkoutError();            
        }
        // 4. Final
        if ($request->final != number_format($total - $discount, 2, ',', '.')) {
            return $this->checkoutError();            
        }

        // Success
        foreach ($transactions as $transaction) {
            $transaction->status = Transaction::STATUS_BOUGHT;
            if ($request->points > 0) {
                // Update points to be given
                $transaction->points = $this->getPoints($request->final);
            }
            $transaction->save();
        }
        $request->user()->points = $request->user()->points - $request->points;
        $request->user()->save();
        $this->updateInCartSessionValue();

        return redirect('myShopping')->with('checkedout', true);
    }


    private function checkoutError() {

        return back()->withErrors('La compra no pudo realizarse. Vuelva a intentarlo');
    }


    public function cancel(Request $request, TransactionService $transactionService, $id) {

        $request->user()->authorizeRoles('user');

        $transaction = Transaction::where('id', $id)->bought()->firstOrFail();
        $transactionService->cancelTransaction($transaction);

        return redirect('myShopping')->with('cancelled', true);
    }


    public function updateInCartSessionValue() {
        
        session([
            'in_cart' => Transaction::forLoggedUser()->inCart()->count()
        ]);
    }
}
