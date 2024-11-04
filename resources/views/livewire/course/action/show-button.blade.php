@props(['id'])

<?php
use function Livewire\Volt\{state, computed};
use App\Models\Course;

state(['id']);

$course = computed(fn() => Course::findOrFail($this->id));
$link = computed(fn() => route('courses.single', $this->course->slug));
$navigate = fn() => $this->redirect($this->link, navigate: true);
?>

<div>
  <x-primary-button wire:click="navigate">View</x-primary-button>
</div>
