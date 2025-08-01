@extends('backoffice.layouts.app')
@section('breadcrumb', 'Detail Jamaah')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-slate-800">Detail Jamaah</h2>

    <table class="table-auto w-full text-sm text-slate-700" style="border-collapse: collapse;">
        <tbody>
            <tr>
                <td class="font-semibold w-48 py-2">Nama Lengkap</td>
                <td class="px-2">:</td>
                <td>{{ $jamaah->name }}</td>
            </tr>
            <tr>
                <td class="font-semibold w-48 py-2">Tanggal Lahir</td>
                <td class="px-2">:</td>
                <td>{{ \Carbon\Carbon::parse($jamaah->dob)->format('d - m - Y') }}</td>
            </tr>
            <tr>
                <td class="font-semibold w-48 py-2">No. Whatsapp / Handphone</td>
                <td class="px-2">:</td>
                <td>{{ $jamaah->phone }}</td>
            </tr>
            <tr>
                <td class="font-semibold w-48 py-2">Email</td>
                <td class="px-2">:</td>
                <td>{{ $jamaah->email }}</td>
            </tr>
            <tr>
                <td class="font-semibold w-48 py-2 align-top">Alamat Lengkap</td>
                <td class="px-2 align-top">:</td>
                <td>{{ $jamaah->address }}</td>
            </tr>
            <tr>
                <td class="font-semibold w-48 py-2 align-top">Jumlah Event Yang Pernah Diikuti</td>
                <td class="px-2 align-top">:</td>
                <td>{{ $jumlahEvent }}</td>
            </tr>
        </tbody>
    </table>
    <div class="mt-8">
        <h3 class="text-lg font-semibold mb-4">Event Yang Pernah Diikuti</h3>
        <table id="eventsTable" class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Gambar</th>
                    <th class="px-4 py-2 border">Nama Event</th>
                    <th class="px-4 py-2 border">Pendaftaran</th>
                    <th class="px-4 py-2 border">Check In</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $index => $event)
                <tr>
                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">
                        <img src="{{ $event->poster_url ? asset($event->poster_url) : asset('admin/assets/img/login_design.png') }}" class="w-20 h-12 object-cover rounded">
                    </td>
                    <td class="px-4 py-2 border">{{ $event->event_name }}</td>
                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($event->registered_at)->format('d M Y / H:i') }}</td>
                    <td class="px-4 py-2 border">{{ $event->check_in_at ? \Carbon\Carbon::parse($event->check_in_at)->format('d M Y / H:i') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-6 text-right">
        <a href="{{ route('backoffice.jamaah.index') }}"
               class="inline-block px-6 py-2 text-sm font-semibold text-slate-700 uppercase transition-all duration-150 ease-in bg-gray-200 rounded-lg hover:bg-gray-300">
              Kembali
            </a>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#eventsTable').DataTable({
            paging: true,
            searching: true,
            info: true,
            responsive: true
        });
    });
</script>
@endpush

