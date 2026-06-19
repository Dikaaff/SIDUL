@if ($paginator->hasPages())
    @php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        if ($last <= 2) {
            $rangeStart = 1;
            $rangeEnd = $last;
        } elseif ($current == $last) {
            $rangeStart = $current - 1;
            $rangeEnd = $current;
        } else {
            $rangeStart = $current;
            $rangeEnd = $current + 1;
        }
    @endphp
    <nav role="navigation" aria-label="Pagination Navigation" class="w-full">
        {{-- Mobile --}}
        <div class="flex items-center justify-between sm:hidden">
            <div class="flex items-center gap-2">
                @if ($paginator->onFirstPage())
                    <span class="btn btn-sm h-10 bg-white border border-gray-100 text-gray-300 rounded-2xl px-3 font-black cursor-not-allowed shadow-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span class="text-[9px] uppercase tracking-widest">Prev</span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-sm h-10 bg-white hover:bg-gray-50 border border-gray-100 text-gray-700 hover:text-[#6B21A8] rounded-2xl px-3 font-black uppercase tracking-widest text-[9px] shadow-sm hover:shadow-md hover:shadow-purple-200/30 transition-all active:scale-95">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>Prev</span>
                    </a>
                @endif

                <span class="text-[11px] font-bold text-gray-400 px-2">
                    {{ $current }} / {{ $last }}
                </span>

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-sm h-10 bg-white hover:bg-gray-50 border border-gray-100 text-gray-700 hover:text-[#6B21A8] rounded-2xl px-3 font-black uppercase tracking-widest text-[9px] shadow-sm hover:shadow-md hover:shadow-purple-200/30 transition-all active:scale-95">
                        <span>Next</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    </a>
                @else
                    <span class="btn btn-sm h-10 bg-white border border-gray-100 text-gray-300 rounded-2xl px-3 font-black cursor-not-allowed shadow-sm">
                        <span class="text-[9px] uppercase tracking-widest">Next</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    </span>
                @endif
            </div>
        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between">
            <div class="text-[11px] text-gray-400 font-bold tracking-wide">
                @if ($paginator->firstItem())
                    <span>Menampilkan <span class="text-[#6B21A8]">{{ $paginator->firstItem() }}</span> - <span class="text-[#6B21A8]">{{ $paginator->lastItem() }}</span> dari <span class="text-[#6B21A8]">{{ $paginator->total() }}</span> data</span>
                @else
                    <span>{{ $paginator->count() }} data</span>
                @endif
            </div>

            <div class="flex items-center gap-1.5">
                {{-- Prev --}}
                @if ($paginator->onFirstPage())
                    <span class="btn btn-sm h-9 w-9 bg-white border border-gray-100 text-gray-300 rounded-2xl p-0 font-black cursor-not-allowed shadow-sm flex items-center justify-center">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-sm h-9 w-9 bg-white hover:bg-gray-50 border border-gray-100 text-gray-500 hover:text-[#6B21A8] rounded-2xl p-0 font-black shadow-sm hover:shadow-md hover:shadow-purple-200/30 transition-all active:scale-95 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    </a>
                @endif

                {{-- Pages -- sliding window max 2 --}}
                @for ($page = $rangeStart; $page <= $rangeEnd; $page++)
                    @php $url = $paginator->url($page); @endphp
                    @if ($page == $current)
                        <span class="btn btn-sm h-9 min-w-[2.25rem] bg-[#6B21A8] text-white rounded-2xl px-3 font-black text-xs shadow-lg shadow-purple-200 flex items-center justify-center cursor-default">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="btn btn-sm h-9 min-w-[2.25rem] bg-white hover:bg-gray-50 border border-gray-100 text-gray-600 hover:text-[#6B21A8] rounded-2xl px-3 font-black text-xs shadow-sm hover:shadow-md hover:shadow-purple-200/30 transition-all active:scale-95 flex items-center justify-center">{{ $page }}</a>
                    @endif
                @endfor

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-sm h-9 w-9 bg-white hover:bg-gray-50 border border-gray-100 text-gray-500 hover:text-[#6B21A8] rounded-2xl p-0 font-black shadow-sm hover:shadow-md hover:shadow-purple-200/30 transition-all active:scale-95 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    </a>
                @else
                    <span class="btn btn-sm h-9 w-9 bg-white border border-gray-100 text-gray-300 rounded-2xl p-0 font-black cursor-not-allowed shadow-sm flex items-center justify-center">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
