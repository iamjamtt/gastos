@props([
    'breadcrumbs' => null,
    'button' => null,
])

<div class="sm:border-b border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900">
    <div class="flex flex-col sm:flex-row justify-between sm:items-center px-3 py-2 sm:h-12 mx-auto m-0 gap-2 sm:gap-0">
        {{ $breadcrumbs ?? '' }}
        {{ $button ?? '' }}
    </div>
</div>
