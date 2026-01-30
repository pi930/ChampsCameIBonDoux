@props(['align' => 'right', 'width' => '48'])

@php
    $alignmentClasses = match($align) {
        'left' => 'origin-top-left left-0',
        'center' => 'origin-top',
        default => 'origin-top-right right-0',
    };

    $widthClasses = match($width) {
        '48' => 'w-48',
        default => 'w-48',
    };
@endphp

<div class="relative" x-data="{ open: false }">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
         @click.outside="open = false"
         x-transition
         class="absolute z-50 mt-2 rounded-md shadow-lg {{ $alignmentClasses }} {{ $widthClasses }}">
        <div class="rounded-md bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 py-1">
            {{ $content }}
        </div>
    </div>
</div>
