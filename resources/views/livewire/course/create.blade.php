<?php

use function Livewire\Volt\{state, rules, usesFileUploads};

use Milwad\LaravelValidate\Rules\ValidSlug;
use Illuminate\Support\Str;

usesFileUploads();

state([
    'title' => '',
    'description' => '',
    'slug' => '',
    'thumbnail',
]);

state('json');

rules([
    'title' => 'required|string|max:256',
    'description' => 'nullable|string|max:2048',
    'slug' => ['nullable', 'string', new ValidSlug()],
    'thumbnail' => 'image|max:1024',
]);

$submit = function () {
    $validated = $this->validate();

    $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

    $validated['thumbnail'] = $validated['thumbnail']->store('course-thumbnails');

    
    $this->dispatch('course-stored');
};
?>

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
      <input type="file" wire:model="thumbnail">

      @error('photo')
        <span class="error">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button>{{ __('Save') }}</x-primary-button>

      <x-action-message class="me-3" on="course-stored">
        {{ __('Saved.') }}
      </x-action-message>
    </div>
  </form>
</section>
