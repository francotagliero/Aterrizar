<?php

namespace App\Listeners;

use App\Transaction;
use App\Services\TransactionService;

class UserEventSubscriber
{
    private $transactionService;

    public function __construct(TransactionService $transactionService) {

        $this->transactionService = $transactionService;
    }

    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {}

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {

        $this->transactionService->clearCart($event->user);
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
