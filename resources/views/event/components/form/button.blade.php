@props([ 'label', 'href' => null, 'variant' => 'primary' ])

@php
    $base = 'w-full block text-center font-bold py-3 px-6 rounded-lg';
    $variants = [
        'primary' => 'bg-yellow-400 text-gray-900 hover:bg-yellow-500',
        'secondary' => 'bg-gray-800 text-white hover:bg-gray-700',
        'submit' => 'bg-yellow-400 text-gray-900 hover:bg-yellow-500 disabled:bg-gray-400 disabled:cursor-not-allowed',
    ];
    $classes = trim("{$base} " . ($variants[$variant] ?? $variants['primary']));
@endphp
@if($href)
    <a href="{{ $href }}" class="{{ $classes }}">{{ $label }}</a>
@else
    <button type="submit" id="submit-button" class="{{ $classes }}" {{ $attributes }}>
        {{ $label }}
    </button>
@endif
