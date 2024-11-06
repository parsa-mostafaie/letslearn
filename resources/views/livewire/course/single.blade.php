<?php
use function Livewire\Volt\{state, computed, on, mount};
use App\Models\Course, App\Events\CourseViewedEvent;

state(['course']);

on([
    'course-single-reload' => function () {
        $this->course->fresh();
    },
]);

mount(function () {
    event(new CourseViewedEvent($this->course, auth()->user()));
});
?>

<div class="flex gap-6">
  <img src="{{ $course->image_url }}" alt="Course Image" class="rounded-lg" />
  <div class="grow">
    <h1 class="font-bold text-lg flex justify-between mb-2">
      {{ $course->title }}
      <div>
        @can('enroll', $this->course)
          <livewire:course.action.enroll-button :course="$this->course" />
        @endcan
      </div>
    </h1>
    {{ $course->description }}
    <p class="text-gray-400">{{ $course->author->name }}</p>
  </div>
</div>
