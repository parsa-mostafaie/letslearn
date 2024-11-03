@props(['course'])

<?php
use function Livewire\Volt\state;

state(['course']);

$getCourse = fn() => $this->course;
?>

<div>
  <livewire:course.action.edit-button :course="$this->course"></livewire:course.action.edit-button>
</div>
