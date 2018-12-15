<?php

namespace App\Services;

use App\{Transaction, User};

class TransactionService {


    public function clearCart(User $user) {

        foreach (Transaction::forUser($user)->inCart()->get() as $transaction) {
            $this->removeFromCart($transaction);
        }
    }


    private function undoTransaction(Transaction $transaction) {

        if ($transaction->service->serviceType === 'Flight') {
            $flight = $transaction->service;
            $flight->increaseCapacity(1, $transaction->detail->class);
            $stop = $transaction->detail->stop;
            if ($stop !== null) {
                $stop->increaseCapacity(1, $transaction->detail->class);
                $stop->save();
            }
            $flight->save();
        }
    }


    public function removeFromCart(Transaction $transaction) {

        $this->undoTransaction($transaction);
        $transaction->delete();     
    }


    public function cancelTransaction(Transaction $transaction) {

        $this->undoTransaction($transaction);
        $transaction->status = Transaction::STATUS_CANCELLED;
        $transaction->save();     
    }
}
