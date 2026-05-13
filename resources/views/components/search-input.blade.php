@props([
    'id'          => 'searchInput',
    'placeholder' => 'Cari data...',
    'onkeyup'     => null,
])

<div class="relative w-full">
    {{-- Search icon --}}
    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>

    <input
        id="{{ $id }}"
        type="text"
        placeholder="{{ $placeholder }}"
        @if($onkeyup) onkeyup="{{ $onkeyup }}" @endif
        {{ $attributes->merge(['class' => 'w-full h-12 pl-14 pr-5 rounded-2xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-purple-100 focus:border-[#6B21A8] outline-none transition text-sm font-semibold']) }}
    >
</div>
