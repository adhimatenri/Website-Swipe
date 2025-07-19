<div class="flex items-center justify-center">
    <a href="{{ route('backoffice.events.show', $e->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{ route('backoffice.events.edit', $e->id) }}"
       class="text-blue-600 hover:text-blue-800 px-2"
       title="Edit">
        <i class="fas fa-pen-to-square"></i>
    </a>

    <button type="button"
        class="btn-delete text-red-600 hover:text-red-800 px-2"
        title="Hapus"
        data-url="{{ route('backoffice.events.destroy', $e->id) }}">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>
