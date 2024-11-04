@props(['course'])

<?php
use function Livewire\Volt\state;

state(['course']);

$getCourse = fn() => $this->course;
?>

<div class="flex gap [&>*:not(:first-child)]:rounded-l-none  [&>*:not(:first-child)>*]:rounded-l-none [&>*:not(:last-child)>*]:rounded-r-none [&>*:not(:last-child)]:rounded-r-none">
  <livewire:course.action.edit-button :course="$this->course" />
  <livewire:course.action.enroll-button :id="$this->course" />
  <livewire:course.action.show-button :id="$this->course" />
</div>
