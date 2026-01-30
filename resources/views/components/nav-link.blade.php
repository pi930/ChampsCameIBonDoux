@props(['active'])

@php
    $classes = $active
        ? 'inline-flex items-center px-3 py-2 border-b-2 border-green-600 text-sm font-medium text-gray-900 dark:text-white'
        : 'inline-flex items-center px-3 py-2 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-300 dark:hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

