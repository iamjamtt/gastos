<div
    {{ $attributes->merge([
        'class' => 'flex flex-col gap-4 overflow-hidden rounded-xl border border-zinc-200 bg-white text-zinc-800 shadow-xs dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 dark:shadow-none',
    ]) }}
>
    {{ $slot }}
</div>
