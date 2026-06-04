@props([
    'disabled' => false,
    'required' => false,
    'label' => '',
    'name' => '',
])

<div>
    @if($label)
        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1 italic" for="{{ $attributes->get('id', $name) }}">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    <select 
        {{ $disabled ? 'disabled' : '' }} 
        {{ $required ? 'required' : '' }} 
        name="{{ $name }}" 
        {!! $attributes->merge([
            'id' => $name,
            'class' => 'w-full bg-gray-50 border border-gray-100 rounded py-4 px-6 text-sm font-black text-gray-800 focus:bg-white focus:ring-4 focus:ring-[#6B21A8]/5 outline-none transition-all cursor-pointer ' . ($disabled ? 'cursor-not-allowed opacity-70' : '')
        ]) !!}
    >
        {{ $slot }}
    </select>
</div>
