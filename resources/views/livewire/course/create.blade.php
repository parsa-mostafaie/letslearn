<?php

use function Livewire\Volt\{state, rules, usesFileUploads};

use Milwad\LaravelValidate\Rules\ValidSlug;
use Illuminate\Support\Str;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

usesFileUploads();

state([
    'title' => '',
    'description' => '',
    'slug' => '',
    'thumbnail',
]);

rules([
    'title' => 'required|string|max:256',
    'description' => 'nullable|string|max:2048',
    'slug' => ['nullable', 'string', new ValidSlug(), 'unique:courses'],
    'thumbnail' => 'nullable|image|max:1024',
]);

$submit = function () {
    $data = $this->validate();

    $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

    if ($data['thumbnail']) {
        $data['thumbnail'] = $data['thumbnail']->store('course-thumbnails');
    }

    Auth::user()->courses()->create($data);

    $this->dispatch('course-stored');
    $this->dispatch('courses-table-reload');

    $this->reset();
}; ?>

<section class="m-2 mx-3">
  <div>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Add a course') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      {{ __('Create a new course') }}
    </p>
  </div>

  <form wire:submit="submit" class="mt-6 space-y-6">
    <div>
      <x-input-label for="title" :value="__('Title')" />
      <x-text-input wire:model="title" id="title" class="block mt-1 w-full" type="text" name="title" required
        autofocus autocomplete="title" />
      <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <div>
      <x-input-label for="description" :value="__('Description')" />
      <x-text-input wire:model="description" id="description" class="block mt-1 w-full" type="text"
        name="description" autofocus autocomplete="description" />
      <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
    <div>
      <x-input-label for="slug" :value="__('Slug')" />
      <x-text-input wire:model="slug" id="slug" class="block mt-1 w-full" type="text" name="slug" autofocus
        autocomplete="slug" />
      <x-input-error :messages="$errors->get('slug')" class="mt-2" />
    </div>

    <div>
      <input type="file" wire:model="thumbnail" class="ring-none">

      <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />

      @if ($thumbnail)
        <img class="mt-2 rounded-lg w-[50%] block" src="{{ $thumbnail->temporaryUrl() }}" />
      @endif
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button>{{ __('Save') }}</x-primary-button>

      <x-action-message class="me-3" on="course-stored">
        {{ __('Saved.') }}
      </x-action-message>
    </div>
  </form>
</section>
