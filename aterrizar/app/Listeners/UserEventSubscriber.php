<?php

namespace App\Listeners;

use App\Transaction;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {}

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {

        // Clear cart
        foreach (Transaction::forLoggedUser()->inCart()->get() as $transaction) {
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
            $transaction->delete();
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
    }
}
