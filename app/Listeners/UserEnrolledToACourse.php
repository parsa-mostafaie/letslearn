<?php

namespace App\Listeners;

use App\Events\CourseEnrollment;
use App\Jobs\UserEnrolledToCourse;
use App\Mail\CourseEnrolledByUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserEnrolledToACourse implements ShouldQueue
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
    public function handle(CourseEnrollment $event): void
    {

        /**
         * @var \App\Models\User
         */
        $user = $event->user;

        $course = $event->course;

        activity()
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip(), 'course' => $course->id])
            ->event('enrollment')
            ->log("The $user->activity_identifier user, Registered to Course of `{$course->user->activity_identifier}`: `$course->title`");

        Mail::to($course->author)->send(new CourseEnrolledByUser($user, $course));

    }
}
