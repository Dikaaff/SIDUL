@props([
    'title'    => 'Belum Ada Data',
    'subtitle' => 'Tidak ada informasi untuk ditampilkan.',
    'icon'     => null,
    'colspan'  => null,   {{-- set if used inside a <table> --}}
])

@php $content = <<<'HTML'
    <div class="flex flex-col items-center py-24 px-8 text-center">
        <div class="w-20 h-20 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-300 mb-5 border-2 border-dashed border-gray-200">
HTML; @endphp

@if($colspan)
<tr>
    <td colspan="{{ $colspan }}" class="p-0">
@endif

<div class="flex flex-col items-center py-24 px-8 text-center">
    <div class="w-20 h-20 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-300 mb-5 border-2 border-dashed border-gray-200">
        @if($icon)
            {{ $icon }}
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        @endif
    </div>
    <h4 class="text-lg font-black text-gray-400 italic">{{ $title }}</h4>
    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2">{{ $subtitle }}</p>
</div>

@if($colspan)
    </td>
</tr>
@endif
