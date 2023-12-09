@props(['options', 'selected' => null])

<select {{ $attributes->merge(['class' => 'block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>
    <option value="" disabled selected>Select an option</option>
    @foreach($options as $key => $value)
        <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
