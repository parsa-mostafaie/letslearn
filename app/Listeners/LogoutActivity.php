<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogoutActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        /**
         * @var \App\Models\User
         */
        $user = $event->user;

        activity()
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip(), 'email' => $user->email, 'guard' => $event->guard])
            ->event('logout')
            ->log("The $user->activity_identifier has logged out.");
    }
}
