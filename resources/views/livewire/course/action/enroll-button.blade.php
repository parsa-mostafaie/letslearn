@props(['id'])

<?php
use function Livewire\Volt\state;
use function Livewire\Volt\computed;
use App\Events\{CourseEnrollment, CourseUnenrollment};
use App\Models\Course;

state(['id']);

$course = computed(fn() => Course::find($this->id));

$action = function () {
    if ($this->course->is_enrolled) {
        $this->course->unenroll($user = Auth::user());
        event(new CourseUnenrollment($user, $this->course));
    } else {
        $this->course->enroll($user = Auth::user());
        event(new CourseEnrollment($user, $this->course));
    }

    $this->dispatch('courses-table-reload');
};
?>

<div>
  <x-primary-button wire:click="action">{{ $this->course->is_enrolled ? 'Une' : 'E' }}nroll</x-primary-button>
</div>
