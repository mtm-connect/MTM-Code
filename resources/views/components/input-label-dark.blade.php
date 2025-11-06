@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-m text-white']) }}>
    {{ $value ?? $slot }}
</label>
