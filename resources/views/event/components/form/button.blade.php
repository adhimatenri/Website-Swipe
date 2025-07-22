@props(['label'])

<button type="submit" id="submit-button"
        class="w-full bg-yellow-400 text-gray-900 font-bold py-3 px-6 rounded-lg hover:bg-yellow-500 disabled:bg-gray-400 disabled:cursor-not-allowed">
    {{ $label }}
</button>
