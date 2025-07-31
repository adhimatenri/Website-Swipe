@extends('backoffice.layouts.app')
@section('breadcrumb', 'Detail Event')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="bg-white shadow-soft-xl rounded-2xl p-6">
        <table class="w-full">
            <tr>
                <td class="w-1/3 align-top">
                    <img src="{{ $event->poster_url 
                        ? asset('storage/' . $event->poster_url) 
                        : asset('admin/assets/img/login_design.png') }}" 
                        alt="{{ $event->title }}" 
                        class="w-full h-40 object-cover rounded-lg shadow">
                </td>
                <td class="align-top w-2/3 pl-6">
                    <div class="flex justify-between items-start mb-2">
                      <h3 class="text-xl font-semibold text-slate-800"></h3>
                      <div class="flex items-center">
                        <form action="{{ route('backoffice.events.destroy', $event->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:text-red-700 text-sm flex items-center gap-1 mr-4">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                        <a href="{{ route('backoffice.events.edit', $event->id) }}" 
                           class="text-blue-500 hover:text-blue-700 text-sm flex items-center gap-1">
                            <i class="fas fa-pen-to-square"></i> Edit
                        </a>
                    </div>
                    
                      
                    </div>
                    <div></div>
                    <h3 class="text-xl font-semibold text-slate-800"></h3>
                    <h3 class="text-xl font-semibold text-slate-800">{{ $event->title }}</h3><br>
                    <p class="text-gray-600 text-sm mb-3">{{ $event->description }}</p><br>

                    <div class="space-y-2 text-sm">
                        <div class="flex items-center gap-2 text-gray-600">
                            <i class="fas fa-calendar-alt text-blue-500"></i>
                            <span> : {{ \Carbon\Carbon::parse($event->datetime_start)->format('d M Y, H:i') }} - 
                                  {{ \Carbon\Carbon::parse($event->datetime_end)->format('d M Y, H:i') }}</span>
                        </div>

                        <div class="flex items-center gap-2 text-gray-600">
                            <i class="fas fa-map-marker-alt text-red-500"></i>
                            <span>  : {{ $event->location ?? '-' }}</span>
                        </div>

                        <div>
                            <span class="px-2 py-1 rounded text-xs
                                {{ $event->is_active_event ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $event->is_active_event ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div><br>

                        <div class="flex gap-6 mt-1">
                            <div class="flex items-center gap-2 text-gray-700">
                                <i class="fas fa-users text-blue-600"></i>
                                <span class="font-bold">{{ $registered }}</span> Jamaah Terdaftar
                            </div>
                            <div class="flex items-center gap-2 text-gray-700">
                                <i class="fas fa-user-check text-green-600"></i>
                                <span class="font-bold">{{ $attended }}</span> Jamaah Hadir
                            </div>
                        </div>
                      
                    </div>
                </td>
            </tr>
        </table>
        <div class="mt-8">
          <h4 class="text-lg font-semibold mb-4">Data Jamaah</h4>
          <table id="registrationsTable" class="min-w-full bg-white border border-gray-200 rounded-lg">
              <thead>
                  <tr>
                      <th class="px-4 py-2 border">No</th>
                      <th class="px-4 py-2 border">Nama</th>
                      <th class="px-4 py-2 border">Email</th>
                      <th class="px-4 py-2 border">No Telepon</th>
                      <th class="px-4 py-2 border">Kehadiran</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($registrations as $index => $reg)
                    <tr>
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $reg->name }}</td>  {{-- perbaikan --}}
                        <td class="px-4 py-2 border">{{ $reg->email }}</td>
                        <td class="px-4 py-2 border">{{ $reg->phone }}</td> {{-- perbaikan --}}
                        <td class="px-4 py-2 border">{{ $reg->kehadiran }}</td>
                    </tr>
                @endforeach
            </tbody>
            
          </table>
      </div>
    </div>

  
  
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#registrationsTable').DataTable({
            paging: true,
            searching: true,
            info: true,
            responsive: true
        });
    });
</script>
@endpush
