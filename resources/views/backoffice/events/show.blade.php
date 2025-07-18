@extends('backoffice.layouts.app')
@section('breadcrumb', 'Manajemen Event')
@section('title', 'Detail Event')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6 mx-auto">
      <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
          <h6 class="mb-0 font-bold">Detail Event</h6>
        </div>
        <div class="flex-auto p-6">
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block mb-1 text-sm font-bold text-slate-700">Judul Event</label>
              <input type="text" disabled value="{{ $event->title }}" class="form-input w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
            </div>

            <div>
              <label class="block mb-1 text-sm font-bold text-slate-700">Deskripsi</label>
              <textarea disabled class="form-textarea w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">{{ $event->description }}</textarea>
            </div>

            <div>
              <label class="block mb-1 text-sm font-bold text-slate-700">Waktu Mulai</label>
              <input type="text" disabled value="{{ \Carbon\Carbon::parse($event->datetime_start)->format('d M Y H:i') }}" class="form-input w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
            </div>

            <div>
              <label class="block mb-1 text-sm font-bold text-slate-700">Waktu Berakhir</label>
              <input type="text" disabled value="{{ \Carbon\Carbon::parse($event->datetime_end)->format('d M Y H:i') }}" class="form-input w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
            </div>

            <div>
              <label class="block mb-1 text-sm font-bold text-slate-700">Status</label>
              <input type="text" disabled value="{{ $event->is_active_event ? 'Aktif' : 'Tidak Aktif' }}" class="form-input w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
            </div>

            <div>
              <label class="block mb-1 text-sm font-bold text-slate-700">Lokasi</label>
              <input type="text" disabled value="{{ $event->location }}" class="form-input w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
            </div>

            <div>
              <label class="block mb-1 text-sm font-bold text-slate-700">Peserta Maksimal</label>
              <input type="text" disabled value="{{ $event->max_amount_participants }}" class="form-input w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
            </div>

            <div>
              <label class="block mb-1 text-sm font-bold text-slate-700">Poster</label>
              @if ($event->poster_url)
                <img src="{{ asset('storage/' . $event->poster_url) }}" class="mt-2 rounded shadow max-w-full w-64">
              @else
                <input type="text" disabled value="Tidak ada poster" class="form-input w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
              @endif
            </div>
          </div>

          <div class="mt-6">
            <a href="{{ route('backoffice.events.index') }}"
               class="inline-block px-6 py-2 text-sm font-semibold text-slate-700 uppercase transition-all duration-150 ease-in bg-gray-200 rounded-lg hover:bg-gray-300">
              Kembali
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
