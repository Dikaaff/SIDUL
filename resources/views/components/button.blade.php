@props([
    'type'    => 'button',
    'variant' => 'primary',   {{-- primary | success | danger | secondary | info | link | ghost | disabled --}}
    'size'    => 'md',        {{-- sm | md | lg --}}
    'full'    => false,
    'loading' => false,
])

@php
$variantClass = match($variant) {
    'primary', 'amber'                                           => 'bg-amber-400 hover:bg-amber-500 text-white border-none shadow-lg shadow-amber-100',
    'success', 'green'                                           => 'bg-green-500 hover:bg-green-600 text-white border-none shadow-lg shadow-green-100',
    'danger', 'red'                                              => 'bg-red-500 hover:bg-red-600 text-white border-none shadow-lg shadow-red-100',
    'info', 'blue'                                               => 'bg-blue-500 hover:bg-blue-600 text-white border-none shadow-lg shadow-blue-100',
    'link'                                                       => 'bg-transparent border-none text-gray-500 hover:text-gray-700 hover:underline shadow-none',
    'secondary', 'outline', 'white'                              => 'bg-white border-2 border-gray-100 text-gray-700 hover:bg-gray-50',
    'ghost'                                                      => 'btn-ghost text-gray-400 hover:bg-gray-100 border-none',
    default                                                      => 'bg-gray-100 text-gray-400 border-none cursor-not-allowed',
};  

$sizeClass = match($size) {
    'sm' => 'h-10 px-4 text-[9px]',
    'lg' => 'h-14 px-8 text-[10px]',
    default => 'h-12 px-6 text-[10px]',
};
@endphp

{{-- daisyui: btn, btn-ghost --}}
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
