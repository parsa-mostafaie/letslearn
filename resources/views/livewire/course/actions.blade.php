@props(['course', 'in_show' => false])

<?php
use function Livewire\Volt\{computed, state, on};

use App\Models\Course;

state(['course', 'in_show']);

on([
    'course-single-reload' => function ($course) {
        if ($course == $this->course->id) {
            $this->course_model->fresh();
        }
    },
]);

$course_model = computed(fn() => $this->course instanceof App\Models\Course ? $this->course : Course::findOrFail($this->course));
?>

<div>
  <x-button-group>
    @if ($this->course_model->trashed())
      @can('forceDelete', $this->course_model)
        <livewire:course.action.forcedelete-button :course="$this->course_model" />
      @endcan
      @can('restore', $this->course_model)
        <livewire:course.action.restore-button :course="$this->course_model" />
      @endcan
    @else
      @can('delete', $this->course_model)
        <livewire:course.action.delete-button :course="$this->course_model" />
      @endcan
    @endif
    @if (!$in_show)
      @can('update', $this->course_model)
        <livewire:course.action.edit-button :course="$this->course_model" />
      @endcan
    @endif
    @can('enroll', $this->course_model)
      <livewire:course.action.enroll-button :course="$this->course_model" />
    @endcan
    @if (!$in_show)
      <livewire:course.action.show-button :course="$this->course_model" />
    @endif
  </x-button-group>
</div>
