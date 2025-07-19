<div class="flex items-center justify-center">
    <a href="{{ route('backoffice.users.edit', $user->id) }}"
       class="text-blue-600 hover:text-blue-800 px-2"
       title="Edit">
        <i class="fas fa-pen-to-square"></i>
    </a>

    <button type="button"
        class="btn-delete text-red-600 hover:text-red-800 px-2"
        title="Hapus"
        data-url="{{ route('backoffice.users.destroy', $user->id) }}">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>
