@props([
    'title',
    'subtitle' => '',
    'color' => '#6B21A8',
    'icon' => null
])

<div class="text-white p-6 md:p-8 rounded relative overflow-hidden shadow-2xl mt-2 group" style="background-color: {{ $color }};">
    <!-- Decorative elements -->
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl transition-transform duration-1000 group-hover:scale-110"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl transition-transform duration-1000 group-hover:scale-110"></div>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
        <div>
            @if($icon)
                <div class="mb-3 opacity-80">{{ $icon }}</div>
            @endif
            <h2 class="text-2xl md:text-3xl font-black mb-2 tracking-tight">
                {{ $title }}
            </h2>
            @if($subtitle)
                <p class="text-white/90 font-medium text-sm md:text-base max-w-2xl leading-relaxed italic">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
        
        {{ $slot }}
    </div>
</div>
