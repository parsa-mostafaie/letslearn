@props(['id'])

<?php
use function Livewire\Volt\{state, computed};
use App\Models\Course;

state(['course']);

$link = computed(fn() => route('courses.single', $this->course->slug));
$navigate = fn() => $this->redirect($this->link, navigate: true);
?>

<div>
  <x-primary-button wire:click="navigate">View</x-primary-button>
</div>
