<?php

use function Livewire\Volt\{state, rules, usesFileUploads, on};

use Milwad\LaravelValidate\Rules\ValidSlug;
use Illuminate\Support\Str;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

usesFileUploads();

state(['thumbnail', 'title' => '', 'description' => '', 'slug' => '']);

state(['course' => null])->modelable();

rules([
    'title' => 'required|string|max:256',
    'description' => 'nullable|string|max:2048',
    'slug' => ['nullable', 'string', new ValidSlug()],
    'thumbnail' => 'nullable|image|max:1024',
]);

on([
    'edit-course' => function ($course_id) {
        $this->course = Course::find($course_id);

        if ($this->course) {
            $this->title = $this->course->title;
            $this->description = $this->course->description;
            $this->slug = $this->course->slug;

            $this->dispatch('course-update-form-opened');
        }
    },
]);

$submit = function () {
    if (!$this->course) {
        return;
    }

    $data = $this->validate(['slug' => [Rule::unique('courses')->ignore($this->course)]]);

    $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

    if (!empty($data['thumbnail'])) {
        $data['thumbnail'] = $data['thumbnail']->store('course-thumbnails');
        $this->course->removePreviousImage();
    }

    unset($data['course']);

    // Save the course with updated data
    $this->course->update($data);

    $this->dispatch('courses-table-reload');
    $this->dispatch('course-updated');

    $this->reset();
};
?>

<section class="m-2 mx-3" id="edit-course-section">
  <div>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Edit a course') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      {{ __('Edit a course') }}
    </p>
  </div>

  <form wire:submit="submit" class="mt-6 space-y-6" @if (!$course) inert @endif>
    <div>
      <x-input-label for="title" :value="__('Title')" />
      <x-text-input :disabled="!$course" wire:model="title" id="title" class="block mt-1 w-full" type="text"
        name="title" required autofocus autocomplete="title" />
      <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
      <x-input-label for="description" :value="__('Description')" />
      <x-text-input wire:model="description" id="description" class="block mt-1 w-full" type="text"
        name="description" autofocus autocomplete="description" :disabled="!$course" />
      <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div>
      <x-input-label for="slug" :value="__('Slug')" />
      <x-text-input :disabled="!$course" wire:model="slug" id="slug" class="block mt-1 w-full" type="text"
        name="slug" autofocus autocomplete="slug" />
      <x-input-error :messages="$errors->get('slug')" class="mt-2" />
    </div>

    <div>
      <input type="file" wire:model="thumbnail" class="ring-none" @disabled(!$course)>

      <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />

      @if ($thumbnail || $course)
        <img class="mt-2 rounded-lg w-[50%] block"
          src="{{ $thumbnail ? $thumbnail->temporaryUrl() : $course?->image_url }}" />
      @endif
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button :disabled="!$course">{{ __('Save') }}</x-primary-button>
    </div>
  </form>
</section>

@script
  <script>
    $wire.on('course-update-form-opened', () => {
      const section = document.getElementById('edit-course-section');

      if (section) {
        section.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });

    $wire.on('course-updated', () => {
      document.body.scrollIntoView({
        behavior: 'smooth'
      });
    });
  </script>
@endscript
