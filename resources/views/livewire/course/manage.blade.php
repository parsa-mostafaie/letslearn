<section class="m-2 mx-3">
  <div>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Courses') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      {{ __('Manager your own courses') }}
    </p>

    <div class="overflow-auto mt-3">
      <livewire:courses-table />
    </div>
  </div>
</section>
