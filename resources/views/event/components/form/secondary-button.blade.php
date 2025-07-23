@props(['label', 'href' => '#'])

<a href="{{ $href }}"
   class="w-full block text-center bg-gray-800 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-700">
    {{ $label }}
</a>
