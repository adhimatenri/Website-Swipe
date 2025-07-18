@extends('backoffice.layouts.app')
@section('breadcrumb', 'Manajemen Jamaah')

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
            <h6 class="text-lg font-semibold text-slate-700">Data Jamaah</h6>
              </div>
    
            <div class="overflow-x-auto rounded-xl">
            <div id="alert-container"></div>
            <table id="jamaah-table" class="min-w-full table-auto border border-slate-200 divide-y divide-slate-200 text-sm text-left">
                <thead class="bg-gray-100 text-slate-600">
                <tr>
                    <th class="px-4 py-2 font-bold uppercase">#</th>
                    <th class="px-4 py-2 font-bold uppercase">Nama</th>
                    <th class="px-4 py-2 font-bold uppercase">Email</th>
                    <th class="px-4 py-2 font-bold uppercase">Alamat</th>
                    <th class="px-4 py-2 font-bold uppercase">Tanggal</th>
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
        $(function () {
            const table = $('#jamaah-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("backoffice.jamaah.data") }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'address', name: 'address' },
                    { data: 'created_at', name: 'created_at', orderable: false, searchable: false },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: "text-center"
                    }
                ]


            });
        });
    </script>
@endpush


