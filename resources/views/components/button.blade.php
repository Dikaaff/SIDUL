@props([
    'type'    => 'button',
    'variant' => 'primary',   {{-- primary | amber | green | red | blue | ghost | outline | white --}}
    'size'    => 'md',        {{-- sm | md | lg --}}
    'full'    => false,
    'loading' => false,
])

@php
$variantClass = match($variant) {
    'primary'  => 'bg-primary hover:bg-purple-700 text-white border-none shadow-lg shadow-purple-100',
    'amber'    => 'bg-[#F49E0A] hover:bg-orange-600 text-white border-none shadow-lg shadow-orange-100',
    'green'    => 'bg-green-600 hover:bg-green-700 text-white border-none',
    'red'      => 'bg-red-500 hover:bg-red-600 text-white border-none',
    'blue'     => 'bg-blue-600 hover:bg-blue-700 text-white border-none',
    'ghost'    => 'btn-ghost text-gray-400 hover:bg-gray-100 border-none',
    'outline'  => 'bg-white border-2 border-gray-100 text-gray-700 hover:bg-gray-50',
    'white'    => 'bg-white hover:bg-gray-50 text-primary border-none shadow-sm',
    default    => 'bg-gray-100 text-gray-400 border-none cursor-not-allowed',
};

$sizeClass = match($size) {
    'sm' => 'h-10 px-4 text-[9px]',
    'lg' => 'h-14 px-8 text-[10px]',
    default => 'h-12 px-6 text-[10px]',
};
@endphp

<button
    type="{{ $type }}"
    {{ $variant === 'disabled' ? 'disabled' : '' }}
    {{ $attributes->merge([
        'class' => trim("btn $variantClass $sizeClass font-black uppercase tracking-widest rounded-2xl transition-all active:scale-95" . ($full ? ' w-full' : '') . ($loading ? ' pointer-events-none' : ''))
    ]) }}
>
    @if($loading)
        <svg class="animate-spin h-4 w-4 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
    @endif
    {{ $slot }}
</button>
