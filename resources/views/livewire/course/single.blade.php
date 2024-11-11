@props(['in_feed'])

<?php
use function Livewire\Volt\{state, computed, on, mount};
use App\Models\Course, App\Events\CourseViewedEvent;

state(['course', 'in_feed']);

on([
    'course-single-reload' => function ($course) {
        if ($course == $this->course->id) {
            $this->course->fresh();
        }
    },
]);

mount(function () {
    if ($this->in_feed) {
        return;
    }
    event(new CourseViewedEvent($this->course, auth()->user()));
});
?>

<div class="flex gap-6">
  <img src="{{ $course->image_url }}" alt="Course Image" class="rounded-lg" />
  <div class="grow">
    <h1 class="font-bold text-lg flex justify-between mb-2">
      <a href="{{ route('courses.single', $course->slug) }}">{{ $course->title }}</a>
      <livewire:course.actions :course="$this->course" :in_show="true" />
    </h1>
    {{ $course->description }}
    <p class="text-gray-400">{{ $course->author->name }}</p>
    <p class="text-gray-500">{{ $course->enrolls()->count() }} Enrolled Users</p>
  </div>
</div>
