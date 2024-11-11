<?php

use App\Models\Course;
use function Livewire\Volt\{mount, state};

state(['limit' => 5, 'offset' => 0, 'courses' => collect([]), 'ncount' => 5]);

$loadMore = function () {
    // Fetch new courses based on the current offset and limit
    $newCourses = Course::skip($this->offset)
        ->take($this->limit)
        ->get()
        ->shuffle();

    // Update the count of new courses
    $this->ncount = $newCourses->count();

    // Merge new courses into the existing collection
    $this->courses = $this->courses->merge($newCourses);

    // Increment the offset for the next load
    $this->offset += $this->limit;
};

// Load initial courses when the component mounts
mount(fn() => $this->loadMore());
?>
<div x-data="{ loading: false }" @scroll.window="if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) { if (!loading) { loading = true; $wire.loadMore().then(() => { loading = false; }); } }">
  <div class="flex flex-col gap-6">
    @foreach ($this->courses as $course)
      <livewire:course.single :$course :in_feed='true' wire:key="{{ $course->id }}" />
    @endforeach

    @if ($this->ncount == $this->limit)
      <div class="p-2"></div>
    @endif
  </div>

  <div wire:loading>Loading more courses...</div>
</div>
