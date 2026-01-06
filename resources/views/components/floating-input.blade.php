@props([
    'id',
    'name',
    'type' => 'text',
    'label',
    'value' => '',
    'required' => false,
    'placeholder' => '',
    'pattern' => null,
])

       
       <div class="relative">
    <input 
        type="{{ $type }}" 
        id="{{ $id }}" 
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if($pattern) pattern="{{ $pattern }}" @endif
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'peer w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-lg text-gray-900 text-base focus:outline-none focus:border-blue-500 transition-all duration-300 placeholder-transparent']) }}
        placeholder="{{ $placeholder ?: $label }}">
    <label for="{{ $id }}"
        class="absolute left-3 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
        peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 peer-placeholder-shown:left-4
        peer-focus:-top-2.5 peer-focus:left-3 peer-focus:text-sm peer-focus:text-blue-500 peer-focus:bg-white peer-focus:px-2">
        {{ $label }}
    </label>
</div>
