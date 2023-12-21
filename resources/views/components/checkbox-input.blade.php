@props(['id', 'name', 'value' => '', 'checked'])

<div>
    <input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }} {!! $attributes->merge(['class' => 'custom-input-style']) !!}>
    <label for="{{ $id }}">{{ $slot }}</label>
</div>
