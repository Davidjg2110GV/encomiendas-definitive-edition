@props(['href', 'active', 'icon', 'gradient' => 'from-yellow-400 to-orange-500'])

@php
$classes = $active ?? false
            ? 'flex items-center px-4 py-3 text-white bg-gray-800/50 rounded-lg'
            : 'flex items-center px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-700/50 rounded-lg transition-all duration-300';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    <div class="mr-3 bg-gradient-to-r {{ $gradient }} p-2 rounded-lg">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
        </svg>
    </div>
    <span>{{ $slot }}</span>
</a>