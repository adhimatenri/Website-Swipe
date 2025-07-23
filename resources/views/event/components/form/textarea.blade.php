@props(['label', 'name'])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $label }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}" rows="4"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
</div>
