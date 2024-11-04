<?php

namespace App\Listeners;

use App\Events\CourseViewedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CourseViewed
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
    public function handle(CourseViewedEvent $event): void
    {
        $course = $event->course;
        $user = $event->user;

        activity()
            ->performedOn($course)
            ->causedBy($user)
            ->event('course-viewed')
            ->log("The $user->activity_identifier has viewed the `$course->title` course.");
    }
}
