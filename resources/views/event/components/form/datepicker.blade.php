@props(['label', 'name'])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $label }}</label>
    <div class="relative">
        <input type="text" id="{{ $name }}" name="{{ $name }}"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
               onfocus="(this.type='date')"
               onblur="(this.type='text')"
               placeholder="dd-mm-yyyy">
        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
            <i class="far fa-calendar-alt text-gray-500"></i>
        </div>
    </div>
</div>
