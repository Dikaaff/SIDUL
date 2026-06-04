{{--
    Reusable Card Component
    Usage:
    <x-card
        class="additional-classes"
        header="Card Header"
        footer="Card Footer"
        shadow="sm|md|lg|none"
        border
        rounded-2xl
        padding
    >
        <!-- Card Content -->
    </x-card>

    Examples:
    <x-card class="bg-white p-6">
        <!-- Content -->
    </x-card>
--}}
@props([
    'shadow' => 'sm',
    'border' => false,
    'rounded_2xl' => true,
    'padding' => false,
    'header' => null,
    'footer' => null,
    'class' => '',
])

<div
    class="
        {{ str_contains($class, 'bg-') ? '' : 'bg-white' }}
        {{ $shadow === 'sm' ? 'shadow-sm' : ($shadow === 'md' ? 'shadow-md' : ($shadow === 'lg' ? 'shadow-lg' : ($shadow === 'none' ? 'shadow-none' : 'shadow-sm'))) }}
        {{ $border ? 'border border-gray-100' : '' }}
        {{ $rounded_2xl ? 'rounded-2xl' : 'rounded-none' }}
        {{ $padding === 'large' ? 'p-8' : ($padding === 'small' ? 'p-4' : ($padding === 'none' ? 'p-0' : 'p-6')) }}
        overflow-hidden
        {{ $class }}
    "
>
    @if($header)
        <div class="mb-6">
            {{ $header }}
        </div>
    @endif

    {{ $slot }}

    @if($footer)
        <div class="mt-6">
            {{ $footer }}
        </div>
    @endif
</div>
