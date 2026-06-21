@props([
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
])

<div>
    @if($label)
        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1" for="{{ $attributes->get('id', $name) }}">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    <input 
        {{ $disabled ? 'disabled' : '' }} 
        {{ $readonly ? 'readonly' : '' }} 
        {{ $required ? 'required' : '' }} 
        type="{{ $type }}" 
        name="{{ $name }}" 
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        {!! $attributes->merge([
            'id' => $name,
            'class' => 'w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-semibold text-gray-700 focus:bg-white focus:ring-4 focus:ring-[#6B21A8]/5 outline-none transition-all ' . ($readonly ? 'cursor-not-allowed italic' : '')
        ]) !!}
    />
</div>
