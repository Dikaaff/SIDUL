{{--
    Reusable Modal/Dialog Component
    Usage:
    <x-modal
        id="unique-modal-id"
        title="Modal Title"
        width="sm|md|lg|xl|full"
        @close="closeCallback"
    >
        <!-- Modal Content -->
    </x-modal>

    Examples:
    <x-modal id="revisi_modal" title="Berikan Catatan Revisi">
        <!-- Content -->
    </x-modal>
--}}

@props([
    'id' => 'modal-' . uniqid(),
    'title' => null,
    'width' => 'md',
    'closeCallback' => null,
])

<!-- Modal Overlay -->
<div
    id="{{ e($id) }}_overlay"
    class="fixed inset-0 z-[9999] bg-black/50 hidden"
    @click.outside="close"
    @keydown.escape="close"
></div>

<!-- Modal Dialog -->
<dialog
    id="{{ e($id) }}"
    class="modal modal-bottom sm:modal-middle transition-all duration-300"
>
    <!-- Modal Box -->
    <div class="modal-box p-0 overflow-hidden bg-white rounded-[2.5rem] shadow-2xl relative 
           {{ $width === 'sm' ? 'max-w-sm' :
             ($width === 'md' ? 'max-w-md' :
             ($width === 'lg' ? 'max-w-lg' :
             ($width === 'xl' ? 'max-w-xl' :
             ($width === 'full' ? 'w-full max-w-[90vw]' :
             'max-w-md')))) }} w-11/12 mx-auto">
            <!-- Header -->
            @if($title)
                <div class="bg-gray-50 border-b border-gray-100 p-8 flex items-center justify-between">
                    <div>
                        <h3 class="font-black text-xl text-gray-800 italic uppercase">
                            {{ $title }}
                        </h3>
                    </div>
                </div>
            @endif

            <!-- Body -->
            <div class="p-10 space-y-6">
                {{ $slot }}
            </div>

            <!-- Single Close Button -->
            <button type="button" onclick="closeModal{{ \Illuminate\Support\Str::studly($id) }}()" class="absolute top-6 right-6 btn btn-circle btn-ghost btn-sm text-gray-400 hover:bg-gray-100 transition-all">✕</button>
        </div>
</dialog>

<script>
    // Modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('{{ e($id) }}');
        const overlay = document.getElementById('{{ e($id) }}_overlay');

        if (!modal || !overlay) return;

        // Open modal
        window.openModal{{ \Illuminate\Support\Str::studly($id) }} = function() {
            modal.showModal();
            overlay.classList.remove('hidden');

            // Focus first focusable element
            setTimeout(() => {
                const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                if (focusableElements.length > 0) {
                    focusableElements[0].focus();
                }
            }, 100);
        };

        // Close modal
        window.closeModal{{ \Illuminate\Support\Str::studly($id) }} = function() {
            modal.close();
            overlay.classList.add('hidden');

            // Trigger close callback if provided
            @if($closeCallback)
                {{ $closeCallback }};
            @endif
        };

        // Close on overlay click
        overlay.addEventListener('click', function() {
            closeModal{{ \Illuminate\Support\Str::studly($id) }}();
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.open) {
                closeModal{{ \Illuminate\Support\Str::studly($id) }}();
            }
        });
    });
</script>
