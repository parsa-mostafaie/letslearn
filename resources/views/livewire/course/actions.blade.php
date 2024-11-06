@props(['course_id'])

<?php
use function Livewire\Volt\{computed, state};

use App\Models\Course;

state(['course_id']);

$course = computed(fn() => Course::findOrFail($this->course_id));
?>

<x-button-group>
  @can('delete', $this->course)
    <livewire:course.action.delete-button :course="$this->course" />
  @endcan
  @can('update', $this->course)
    <livewire:course.action.edit-button :course="$this->course" />
  @endcan
  @can('enroll', $this->course)
    <livewire:course.action.enroll-button :course="$this->course" />
  @endcan
  <livewire:course.action.show-button :course="$this->course" />
</x-button-group>
