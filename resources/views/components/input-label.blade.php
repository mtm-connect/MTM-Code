@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-m text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
