@props(['course_id'])

<?php
use function Livewire\Volt\{computed, state};

use App\Models\Course;

state(['course_id']);

$course = computed(fn() => Course::findOrFail($this->course_id));
?>

<div
  class="flex gap [&>*:not(:first-child)]:rounded-l-none  [&>*:not(:first-child)>*]:rounded-l-none [&>*:not(:last-child)>*]:rounded-r-none [&>*:not(:last-child)]:rounded-r-none">
  @can('update', $this->course)
    <livewire:course.action.edit-button :course="$this->course" />
  @endcan
  @can('enroll', $this->course)
    <livewire:course.action.enroll-button :course="$this->course" />
  @endcan
  <livewire:course.action.show-button :course="$this->course" />
</div>
