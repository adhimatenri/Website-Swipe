@props(['label', 'name', 'options'])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}"
            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        @foreach($options as $value => $display)
            <option value="{{ $value }}">{{ $display }}</option>
        @endforeach
    </select>
</div>
