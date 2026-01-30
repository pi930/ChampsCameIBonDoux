@props(['active' => false])

@php
    $classes = $active
        ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-green-600 text-base font-medium text-green-700 bg-green-50'
        : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-700 hover:bg-gray-100 hover:border-gray-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

