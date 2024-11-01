<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginActivity
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
    public function handle(Login $event): void
    {
        /**
         * @var \App\Models\User
         */
        $user = $event->user;

        activity()
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip(), 'email' => $user->email, 'remember' => $event->remember, 'guard' => $event->guard])
            ->event('login')
            ->log("The $user->activity_identifier has logged in.");
    }
}
