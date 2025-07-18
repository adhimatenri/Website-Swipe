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
        </tbody>
    </table>

    <div class="mt-6 text-right">
        <a href="{{ route('backoffice.jamaah.index') }}"
               class="inline-block px-6 py-2 text-sm font-semibold text-slate-700 uppercase transition-all duration-150 ease-in bg-gray-200 rounded-lg hover:bg-gray-300">
              Kembali
            </a>
    </div>
</div>
@endsection
