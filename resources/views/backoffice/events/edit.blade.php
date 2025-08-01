@extends('backoffice.layouts.app')
@section('title', 'Edit Event')
@section('breadcrumb', 'Manajemen Event')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6 mx-auto">
      <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
          <h6 class="mb-0 font-bold">Edit Event</h6>
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

          <form action="{{ route('backoffice.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block mb-2 text-sm font-bold text-slate-700">Judul Event</label>
                <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" required
                       class="form-input block w-full px-3 py-2 border {{ $errors->has('title') ? 'border-red-500' : 'border-slate-300' }} rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                       placeholder="Masukkan judul event">
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-2 text-sm font-bold text-slate-700">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                          class="form-input block w-full px-3 py-2 border {{ $errors->has('description') ? 'border-red-500' : 'border-slate-300' }} rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                          placeholder="Tuliskan deskripsi event">{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="datetime_start" class="block mb-2 text-sm font-bold text-slate-700">Tanggal Mulai</label>
                <input type="datetime-local" id="datetime_start" name="datetime_start"
                       value="{{ old('datetime_start', \Carbon\Carbon::parse($event->datetime_start)->format('Y-m-d\TH:i')) }}"
                       class="form-input block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="datetime_end" class="block mb-2 text-sm font-bold text-slate-700">Tanggal Berakhir</label>
                <input type="datetime-local" id="datetime_end" name="datetime_end"
                       value="{{ old('datetime_end', \Carbon\Carbon::parse($event->datetime_end)->format('Y-m-d\TH:i')) }}"
                       class="form-input block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="location" class="block mb-2 text-sm font-bold text-slate-700">Lokasi</label>
                <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"
                       class="form-input block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                       placeholder="Tulis lokasi event">
            </div>

            <div class="mb-4">
                <label for="max_amount_participants" class="block mb-2 text-sm font-bold text-slate-700">Jumlah Peserta Maksimal</label>
                <input type="number" id="max_amount_participants" name="max_amount_participants"
                       value="{{ old('max_amount_participants', $event->max_amount_participants) }}"
                       class="form-input block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                       placeholder="Contoh: 100">
            </div>

            <div class="mb-4">
                <label for="poster" class="block mb-2 text-sm font-bold text-slate-700">Poster (Ganti jika perlu)</label>
                <input type="file" id="poster" name="poster"
                       class="form-input block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                @if($event->poster_url)
                    <img src="{{ asset($event->poster_url) }}" alt="Poster Event" class="mt-2 w-40 h-auto rounded shadow">
                @endif
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" id="is_active_event" name="is_active_event" {{ $event->is_active_event ? 'checked' : '' }}>
                <label for="is_active_event" class="ml-2 text-sm font-medium text-slate-700">Aktifkan Event</label>
            </div>

            <div class="flex justify-end mt-6">
              <button type="submit"
                      class="inline-block px-6 py-2 text-sm font-semibold text-white uppercase transition-all duration-150 ease-in bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">
                Perbarui
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
