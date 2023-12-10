@props(['id', 'name', 'value' => '', 'checked'])

<div>
    <input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    <label for="{{ $id }}">{{ $slot }}</label>
</div>
