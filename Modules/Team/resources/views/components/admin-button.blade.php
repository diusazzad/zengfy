@props(['href' => null, 'type' => 'button', 'variant' => 'primary', 'title' => ''])

@php
    $baseClasses = "p-2 rounded-lg transition-all duration-200 flex items-center justify-center";
    $variants = [
        'primary' => "bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-600",
        'danger' => "bg-red-50 text-red-600 hover:bg-red-600 hover:text-white dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-600",
        'neutral' => "bg-gray-50 text-gray-600 hover:bg-gray-600 hover:text-white dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600",
    ];
    $classes = $baseClasses . " " . ($variants[$variant] ?? $variants['primary']);
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $classes }}" title="{{ $title }}">
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="{{ $classes }}" title="{{ $title }}">
        {{ $slot }}
    </button>
@endif
