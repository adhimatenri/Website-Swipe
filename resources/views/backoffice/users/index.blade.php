@extends('backoffice.layouts.app')
@section('breadcrumb', 'Manajemen Pengguna')
@section('title', 'Data Pengguna')

@section('content')
    @if (session('success'))
    <div class="mb-4 w-full px-4 py-3 bg-white border-l-4 border-green-500 text-green-700 shadow-md rounded relative" role="alert">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <span class="text-green-500 text-xl">&times;</span>
        </button>
    </div>
    @endif

    @if (session('error'))
    <div class="mb-4 w-full px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
        <strong class="font-bold">Gagal!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <span class="text-red-700">&times;</span>
        </button>
    </div>
    @endif

    <div class="w-full px-6 py-6 mx-auto">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-soft-xl rounded-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h6 class="text-lg font-semibold text-slate-700">Data Pengguna</h6>
                    <a href="{{ route('backoffice.users.create') }}" class="inline-block px-4 py-2 text-white bg-blue-500 rounded shadow hover:bg-blue-600">Tambah Pengguna</a>
                </div>
                <div class="overflow-x-auto rounded-xl">
                    <div id="alert-container"></div>
                    <table id="users-table" class="min-w-full table-auto border border-slate-200 divide-y divide-slate-200 text-sm text-left">
                        <thead class="bg-gray-100 text-slate-600">
                            <tr>
                                <th class="px-4 py-2 font-bold uppercase">#</th>
                                <th class="px-4 py-2 font-bold uppercase">Nama</th>
                                <th class="px-4 py-2 font-bold uppercase">Email</th>
                                <th class="px-4 py-2 font-bold uppercase">Role</th>
                                <th class="px-4 py-2 font-bold uppercase">Jenis Kelamin</th>
                                <th class="px-4 py-2 font-bold uppercase text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 text-slate-700"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        if ($.fn.DataTable.isDataTable('#users-table')) {
            $('#users-table').DataTable().destroy();
        }
        const table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: '{{ route("backoffice.users.data") }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role', orderable: false, searchable: false },
                { data: 'gender', name: 'gender' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center" }
            ]
        });
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            const url = $(this).data('url');
            if (confirm('Yakin ingin menghapus?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        if (response.success) {
                            $('#alert-container').html(`<div class="bg-white border border-green-300 rounded-md p-4 my-4 text-green-700 font-semibold">✅ Data berhasil dihapus.</div>`);
                            setTimeout(() => $('#alert-container').fadeOut(), 3000);
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function () {
                        alert('Terjadi kesalahan saat menghapus data.');
                    }
                });
            }
        });
    });
</script>
@endpush
