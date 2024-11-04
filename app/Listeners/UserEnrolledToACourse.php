<?php

namespace App\Listeners;

use App\Events\CourseEnrollment;
use App\Jobs\SendCourseEnrollmentEmail;
use App\Jobs\UserEnrolledToCourse;
use App\Mail\CourseEnrolledByUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserEnrolledToACourse
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
            ->performedOn($course)
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip()])
            ->event('enrollment')
            ->log("The $user->activity_identifier user, Registered to Course of `{$course->user->activity_identifier}`: `$course->title`");

        SendCourseEnrollmentEmail::dispatch(course: $course, user: $user);
    }
}
