{{--
    Reusable Card Component
    Usage:
    <x-card
        class="additional-classes"
        header="Card Header"
        footer="Card Footer"
        shadow="sm|md|lg|none"
        border
        rounded
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
    'rounded' => true,
    'padding' => false,
    'header' => null,
    'footer' => null,
    'class' => '',
])

<div
    class="
        {{ str_contains($class, 'bg-') ? '' : 'bg-white' }}
        {{ $shadow === 'sm' ? 'shadow-sm' :
          ($shadow === 'md' ? 'shadow-md' :
          ($shadow === 'lg' ? 'shadow-lg' :
          ($shadow === 'none' ? 'shadow-none' :
          'shadow-sm'))) }}
        {{ $border ? 'border border-base-200' : '' }}
        {{ $rounded ? 'rounded-[2rem]' : 'rounded-[2rem]' }}
        {{ $padding ? 'p-8' : 'p-6' }}
        {{ $class ?? '' }}
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
