<?php

namespace App\Listeners;

use App\Events\CourseUnenrollment;
use App\Jobs\SendCourseUnenrollmentEmail;
use App\Mail\CourseUnenrolledByUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserUnenrolledFromACourse implements ShouldQueue
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
    public function handle(CourseUnenrollment $event): void
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
            ->event('unenrollment')
            ->log("The $user->activity_identifier user, Unenrolled Course of `{$course->user->activity_identifier}`: `$course->title`");

        SendCourseUnenrollmentEmail::dispatch(course: $course, user: $user);

    }
}
