@props([
    'value',
    'label',
    'color' => 'purple',   {{-- purple | green | amber | blue | red --}}
    'icon'  => null,
])

@php
    $palette = [
        'purple' => ['bg' => 'bg-purple-50', 'text' => 'text-[#6B21A8]', 'glow' => 'bg-purple-50',  'border' => 'border-purple-100'],
        'green'  => ['bg' => 'bg-green-50',  'text' => 'text-green-600',  'glow' => 'bg-green-50',   'border' => 'border-green-100'],
        'amber'  => ['bg' => 'bg-amber-50',  'text' => 'text-[#F49E0A]',  'glow' => 'bg-amber-50',   'border' => 'border-amber-100'],
        'blue'   => ['bg' => 'bg-blue-50',   'text' => 'text-blue-600',   'glow' => 'bg-blue-50',    'border' => 'border-blue-100'],
        'red'    => ['bg' => 'bg-red-50',    'text' => 'text-red-600',    'glow' => 'bg-red-50',     'border' => 'border-red-100'],
    ][$color] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-600', 'glow' => 'bg-gray-50', 'border' => 'border-gray-100'];
@endphp

<x-card padding="none" class="p-5 flex flex-col justify-center items-center text-center transition-all hover:shadow-md hover:-translate-y-1 relative group overflow-hidden">
    {{-- Glow decoration --}}
    <div class="absolute -right-6 -bottom-6 w-24 h-24 {{ $palette['glow'] }} rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>

    {{-- Icon --}}
    <div class="w-10 h-10 rounded-full {{ $palette['bg'] }} {{ $palette['text'] }} flex items-center justify-center mb-3 relative z-10 border {{ $palette['border'] }}">
        @if($icon)
            {{ $icon }}
        @else
            {{-- Default fallback icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
        @endif
    </div>

    {{-- Value --}}
    <span class="text-2xl font-black text-gray-800 relative z-10">{{ $value }}</span>

    {{-- Label --}}
    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mt-1 relative z-10">{{ $label }}</span>
</x-card>
