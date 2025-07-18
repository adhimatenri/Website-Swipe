@extends('backoffice.layouts.app')
@section('title', 'Tambah Event')
@section('breadcrumb', 'Manajemen Event')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6 mx-auto">
      <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
          <h6 class="mb-0 font-bold">Tambah Event</h6>
        </div>
        <div class="flex-auto p-6">
          @if ($errors->any())
          <div class="mb-4 bg-white border-l-4 border-red-500 text-red-700 p-4 shadow rounded">
            <ul class="list-disc list-inside text-sm">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('backoffice.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
              <label for="title" class="block mb-2 text-sm font-bold text-slate-700">Judul Event</label>
              <input type="text" name="title" id="title" value="{{ old('title') }}" required
                placeholder="Masukkan judul event"
                class="form-input block w-full px-3 py-2 border {{ $errors->has('title') ? 'border-red-500' : 'border-slate-300' }} rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
              <label for="description" class="block mb-2 text-sm font-bold text-slate-700">Deskripsi Event</label>
              <textarea name="description" id="description" rows="4"
                placeholder="Tuliskan deskripsi singkat mengenai event..."
                class="form-textarea block w-full px-3 py-2 border {{ $errors->has('description') ? 'border-red-500' : 'border-slate-300' }} rounded-md focus:outline-none focus:ring focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
              <label for="datetime_start" class="block mb-2 text-sm font-bold text-slate-700">Tanggal & Waktu Mulai</label>
              <input type="datetime-local" name="datetime_start" id="datetime_start" value="{{ old('datetime_start') }}" required
                class="form-input block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
              <label for="datetime_end" class="block mb-2 text-sm font-bold text-slate-700">Tanggal & Waktu Berakhir</label>
              <input type="datetime-local" name="datetime_end" id="datetime_end" value="{{ old('datetime_end') }}" required
                class="form-input block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
              <label for="location" class="block mb-2 text-sm font-bold text-slate-700">Lokasi</label>
              <input type="text" name="location" id="location" value="{{ old('location') }}"
                placeholder="Contoh: Masjid Agung Jakarta"
                class="form-input block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
              <label for="max_amount_participants" class="block mb-2 text-sm font-bold text-slate-700">Jumlah Maksimal Peserta</label>
              <input type="number" name="max_amount_participants" id="max_amount_participants" value="{{ old('max_amount_participants', 0) }}"
                placeholder="Contoh: 100"
                class="form-input block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="poster" class="block mb-2 text-sm font-bold text-slate-700">Upload Poster (JPG/PNG)</label>
                <input type="file" name="poster" id="poster"
                       class="block w-full text-sm text-slate-700 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                @error('poster')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
              

            <div class="mb-4">
              <label for="is_active_event" class="block mb-2 text-sm font-bold text-slate-700">Status Aktif</label>
              <input type="checkbox" name="is_active_event" id="is_active_event" {{ old('is_active_event') ? 'checked' : '' }}>
              <label for="is_active_event" class="text-sm">Aktifkan Event</label>
            </div>

            <div class="flex justify-end mt-6">
              <button type="submit"
                class="inline-block px-6 py-2 text-sm font-semibold text-white uppercase transition-all duration-150 ease-in bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">
                Simpan
              </button>
              <a href="{{ route('backoffice.events.index') }}"
                class="ml-4 inline-block px-6 py-2 text-sm font-semibold text-slate-700 uppercase transition-all duration-150 ease-in bg-gray-200 rounded-lg hover:bg-gray-300">
                Batal
              </a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
