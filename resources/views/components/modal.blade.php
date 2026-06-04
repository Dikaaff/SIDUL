@props([
    'id',
    'title'    => null,
    'subtitle' => null,
    'color'    => 'default',  {{-- default | purple | dark --}}
    'size'     => '2xl',      {{-- sm | md | lg | xl | 2xl | 5xl --}}
])

@php
$maxWidth = match($size) {
    'sm'  => 'max-w-sm',
    'md'  => 'max-w-md',
    'lg'  => 'max-w-lg',
    'xl'  => 'max-w-xl',
    '2xl' => 'max-w-2xl',
    '5xl' => 'max-w-5xl',
    default => 'max-w-2xl',
};
@endphp

{{-- daisyui: modal --}}
<dialog id="{{ $id }}" class="modal modal-bottom sm:modal-middle">
    {{-- daisyui: modal-box --}}
    <div class="modal-box bg-white {{ $maxWidth }} rounded p-0 overflow-hidden border-none shadow-2xl">

        {{-- ===== PURPLE HEADER ===== --}}
        @if($color === 'purple' && $title)
            <div class="bg-[#6B21A8] p-8 text-white relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <div class="flex items-start justify-between relative z-10">
                    <div>
                        <h3 class="font-black text-2xl italic tracking-tighter">{{ $title }}</h3>
                        @if($subtitle)
                            <p class="text-white/70 text-[10px] font-black uppercase tracking-widest mt-1 italic">{{ $subtitle }}</p>
                        @endif
                    </div>
                    {{-- daisyui: btn --}}
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost bg-white/10 hover:bg-white/20 border-none text-white ml-4">✕</button>
                    </form>
                </div>
            </div>
            {{-- Body overlapping header with rounded top --}}
            <div class="p-10 -mt-6 bg-white rounded relative z-20 space-y-6">
                {{ $slot }}
            </div>

        {{-- ===== DARK HEADER ===== --}}
        @elseif($color === 'dark' && $title)
            <div class="bg-gray-900 p-8 text-white flex items-center justify-between relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    @if($subtitle)
                        <p class="text-[10px] font-black text-white/50 uppercase tracking-[0.3em] mb-1 italic">{{ $subtitle }}</p>
                    @endif
                    <h3 class="text-2xl font-black italic tracking-tighter uppercase">{{ $title }}</h3>
                </div>
                {{-- daisyui: btn --}}
                <form method="dialog" class="relative z-10">
                    <button class="btn btn-sm btn-circle btn-ghost bg-white/10 hover:bg-white/20 border-none text-white">✕</button>
                </form>
            </div>
            <div class="p-10 -mt-8 bg-white rounded relative z-20 space-y-8">
                {{ $slot }}
            </div>

        {{-- ===== DEFAULT / GRAY HEADER ===== --}}
        @else
            @if($title)
                <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <div>
                        <h3 class="font-black text-xl text-gray-800 italic">{{ $title }}</h3>
                        @if($subtitle)
                            <p class="text-sm text-gray-400 font-medium mt-1">{{ $subtitle }}</p>
                        @endif
                    </div>
                    {{-- daisyui: btn --}}
                    <form method="dialog">
                        <button class="btn btn-circle btn-ghost btn-sm">✕</button>
                    </form>
                </div>
            @endif
            <div class="p-10 space-y-6">
                {{ $slot }}
            </div>
        @endif

        {{-- ===== OPTIONAL FOOTER SLOT ===== --}}
        @isset($footer)
            <div class="px-10 pb-10 -mt-2">
                {{ $footer }}
            </div>
        @endisset

    </div>
    {{-- Close on backdrop click --}}
    {{-- daisyui: modal-backdrop --}}
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<script>
    (function() {
        const modalId = "{{ $id }}";
        // Mengubah snake_case/kebab-case ke CamelCase (misal: reject_confirmation_modal -> RejectConfirmationModal)
        const camelCaseId = modalId
            .split(/[-_]/)
            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
            .join('');
            
        const openFuncName = `openModal${camelCaseId}`;
        const closeFuncName = `closeModal${camelCaseId}`;
        
        window[openFuncName] = function() {
            const modal = document.getElementById(modalId);
            if (modal && typeof modal.showModal === 'function') {
                modal.showModal();
            }
        };
        
        window[closeFuncName] = function() {
            const modal = document.getElementById(modalId);
            if (modal && typeof modal.close === 'function') {
                modal.close();
            }
        };
    })();
</script>

