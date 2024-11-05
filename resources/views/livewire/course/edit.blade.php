<?php

use function Livewire\Volt\{state, form, usesFileUploads, on, mount};

use Milwad\LaravelValidate\Rules\ValidSlug;
use Illuminate\Support\Str;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Livewire\Forms\CourseForm;

usesFileUploads();

state(['course' => null]);

form(CourseForm::class, 'form');

on([
    'edit-course' => function ($course_id) {
        $course = Course::findOrFail($course_id);

        $this->authorize('update', $course);

        if ($this->form->setModel($course)) {
            $this->dispatch('course-update-form-opened');
        }
    },
]);

$submit = function () {
    if (!$this->form->course) {
        return;
    }

    $this->authorize('update', $this->form->course);

    $this->form->save($this->form->course);

    $this->dispatch('courses-table-reload');
    $this->dispatch('course-updated');
};
?>

<section class="m-2 mx-3" id="edit-course-section" @if (!$this->form->course) tw-none @endif>
  @if ($this->form->course)
    <div>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Edit a course') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Edit a course') }}
      </p>
    </div>

    <form wire:submit="submit" class="mt-6 space-y-6" @if (!$this->form->course) inert @endif>
      <div>
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input :disabled="!$this->form->course" wire:model="form.title" id="title" class="block mt-1 w-full" type="text"
          name="title" required autofocus autocomplete="title" />
        <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
      </div>

      <div>
        <x-input-label for="description" :value="__('Description')" />
        <x-text-input wire:model="form.description" id="description" class="block mt-1 w-full" type="text"
          name="description" autofocus autocomplete="description" :disabled="!$this->form->course" />
        <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
      </div>

      <div>
        <x-input-label for="slug" :value="__('Slug')" />
        <x-text-input :disabled="!$this->form->course" wire:model="form.slug" id="slug" class="block mt-1 w-full" type="text"
          name="slug" autofocus autocomplete="slug" />
        <x-input-error :messages="$errors->get('form.slug')" class="mt-2" />
      </div>

      <div>
        <input type="file" wire:model="form.thumbnail" class="ring-none" @disabled(!$this->form->course)>

        <x-input-error :messages="$errors->get('form.thumbnail')" class="mt-2" />

        @if ($this->form->thumbnail || $this->form->course)
          <img class="mt-2 rounded-lg w-[50%] block"
            src="{{ $this->form->thumbnail ? $this->form->thumbnail->temporaryUrl() : $this->form->course?->image_url }}" />
        @endif
      </div>

      <div class="flex items-center gap-4">
        <x-primary-button :disabled="!$this->form->course">{{ __('Save') }}</x-primary-button>
      </div>
    </form>
  @endif
</section>

@script
  <script>
    $wire.on('course-update-form-opened', () => {
      const section = document.getElementById('edit-course-section');

      if (section) {
        setTimeout(() => {
          section.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }, 0); // 0s: to ensure runned after /livewire/update fetch
      }
    });

    $wire.on('course-updated', () => {
      document.body.scrollIntoView({
        behavior: 'smooth'
      });
    });
  </script>
@endscript
