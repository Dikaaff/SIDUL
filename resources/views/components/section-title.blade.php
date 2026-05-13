@props([
    'title',
    'color' => 'purple',
])

@php
$colorClasses = match($color) {
    'amber' => 'bg-[#F49E0A] shadow-amber-200',
    'indigo' => 'bg-indigo-500 shadow-indigo-200',
    'blue' => 'bg-blue-500 shadow-blue-200',
    'green' => 'bg-green-500 shadow-green-200',
    'red' => 'bg-red-500 shadow-red-200',
    default => 'bg-[#6B21A8] shadow-purple-200',
};
@endphp

<h3 class="font-black text-gray-800 text-lg flex items-center gap-3 border-b border-gray-50 pb-3 italic {{ $attributes->get('class') }}">
    <span class="w-2 h-6 rounded-full inline-block shadow-lg {{ $colorClasses }}"></span>
    {{ $title }}
</h3>
