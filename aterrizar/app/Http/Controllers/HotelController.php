<?php

namespace App\Http\Controllers;

use App\{Hotel, Transaction};
use Illuminate\Http\Request;
use App\Http\Requests\StoreRating;

class HotelController extends Controller
{
    
    public function show($id) {

        $hotel = Hotel::find($id);

        return view('hotels.show')->with('hotel', $hotel);
    }


    public function rate(Request $request, $id) {

        $request->user()->authorizeRoles('user');

        $hotel = Hotel::findOrFail($id);
        $transactions = $this->rateableTransactions($request->user(), $hotel);
        if ($transactions->isEmpty()) {
            abort(403);
        }
        $ratings = [ 1 => '1', '2', '3', '4', '5'];

        return view('hotels.rate')->with(compact('hotel', 'ratings'));
    }


    public function storeRating(StoreRating $request, $id) {

        $request->user()->authorizeRoles('user');

        $hotel = Hotel::find($id);
        $hotel->ratings = $hotel->ratings + $request->rating;
        $hotel->votes = $hotel->votes + 1;
        $hotel->save();
        foreach ($this->rateableTransactions($request->user(), $hotel) as $transaction) {
            $transaction->extra = ['rated' => true];
            $transaction->save();
        }

        return redirect('myShopping')->with('rated', true);
    }


    private function rateableTransactions($user, Hotel $hotel) {

        return Transaction::forUser($user)->consumed()->roomsOnly()->get()->filter(
            function ($transaction, $key) use ($hotel) {
                return $transaction->service->id == $hotel->id
                   and $transaction->extra['rated'] == false;
            }
        );
    } 
}
