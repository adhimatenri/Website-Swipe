@props(['label', 'name'])

<div class="mb-6">
    <label class="flex items-center">
        <input type="checkbox" id="{{ $name }}" name="{{ $name }}" class="form-checkbox h-5 w-5 text-purple-600">
        <span class="ml-2 text-gray-700">{{ $label }}</span>
    </label>
</div>
