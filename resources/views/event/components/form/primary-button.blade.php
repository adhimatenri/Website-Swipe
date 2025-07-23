@props(['label', 'href' => '#'])

<a href="{{ $href }}"
   class="w-full block text-center bg-yellow-400 text-gray-900 font-bold py-3 px-6 rounded-lg hover:bg-yellow-500">
    {{ $label }}
</a>
