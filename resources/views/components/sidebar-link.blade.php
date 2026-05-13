@props(['href', 'active' => false])

@php
    $classes = ($active ?? false)
                ? 'active bg-[#6B21A8] text-white rounded-xl py-3 px-4 font-bold shadow-md flex items-center gap-3 transition-all duration-300'
                : 'hover:bg-purple-50 hover:text-[#6B21A8] text-gray-600 rounded-xl py-3 px-4 font-bold flex items-center gap-3 transition-all duration-300';
@endphp

<li>
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if(isset($icon))
            {{ $icon }}
        @endif
        <span>{{ $slot }}</span>
    </a>
</li>
