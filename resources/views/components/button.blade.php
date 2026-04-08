{{--
    Reusable Button Component
    Usage:
    <x-button
        type="button|submit|reset"
        variant="primary|secondary|success|danger|warning|info|outline"
        size="sm|md|lg"
        class="additional-classes"
        disabled
        loading
    >
        Button Text
    </x-button>

    Examples:
    <x-button variant="primary">Save</x-button>
    <x-button variant="outline" size="sm" type="button" @click="cancel()">Cancel</x-button>
--}}
@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'loading' => false,
    'class' => '',
])

<button
    {{ $type ? 'type="' . e($type) . '"' : 'type="button"' }}
    class="btn
           {{ $variant === 'primary' ? 'bg-primary hover:bg-primary/90' :
             ($variant === 'secondary' ? 'bg-secondary hover:bg-secondary/90' :
             ($variant === 'success' ? 'bg-green-600 hover:bg-green-700' :
             ($variant === 'danger' ? 'bg-red-600 hover:bg-red-700' :
             ($variant === 'warning' ? 'bg-yellow-500 hover:bg-yellow-600' :
             ($variant === 'info' ? 'bg-blue-600 hover:bg-blue-700' :
             ($variant === 'outline' ? 'border border-gray-300 hover:bg-gray-50' :
             'bg-gray-600 hover:bg-gray-700')))))) }}
           {{ $size === 'sm' ? 'h-10 px-4 text-xs' :
             ($size === 'lg' ? 'h-14 px-8 text-lg' :
             'h-12 px-6 text-sm') }}
           {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}
           {{ $loading ? 'relative' : '' }}
           rounded-[1.5rem] font-black uppercase tracking-widest
           shadow-sm transition-all
           {{ $class ?? '' }}
           {{ $loading ? 'pointer-events-none' : '' }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes }}
>
    @if($loading)
        <span class="relative left-0">
            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
        </span>
    @endif

    {{ $slot }}
</button>