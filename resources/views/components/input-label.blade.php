@props(['value'])
<label {{ $attributes->merge(['class' => 'block h-auto font-medium text-sm text-gray-700 ']) }}>
    {{ $value ?? $slot }}
</label>