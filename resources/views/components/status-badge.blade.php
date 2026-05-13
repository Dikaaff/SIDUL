@props(['status'])

@php
    $statusLower = strtolower($status);
    $colorClass = match(true) {
        in_array($statusLower, ['approve', 'aktif', 'selesai', 'diterima']) => 'bg-green-100 text-green-700 border-green-200',
        in_array($statusLower, ['pending', 'menunggu', 'review']) => 'bg-amber-100 text-amber-700 border-amber-200',
        in_array($statusLower, ['reject', 'ditolak', 'gagal']) => 'bg-red-100 text-red-700 border-red-200',
        in_array($statusLower, ['berjalan', 'proses']) => 'bg-blue-100 text-blue-700 border-blue-200',
        default => 'bg-gray-100 text-gray-700 border-gray-200',
    };
@endphp

<span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-[0.1em] border {{ $colorClass }} {{ $attributes->get('class') }}">
    {{ $status }}
</span>
