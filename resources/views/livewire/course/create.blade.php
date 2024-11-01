<?php
use function Livewire\Volt\state;
?>

<section class="m-2 mx-3">
    <div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add a course') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Create a new course") }}
        </p>
    </div>

    <form wire:submit="submit" class="mt-6 space-y-6">
    </form>
</section>
