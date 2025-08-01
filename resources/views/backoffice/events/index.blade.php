@extends('backoffice.layouts.app')
@section('breadcrumb', 'Manajemen Event')

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
                <h6 class="text-lg font-semibold text-slate-700">Data Event</h6>
                <div class="flex gap-3">
                    <a href="{{ route('backoffice.events.scan') }}" 
                    class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 gap-1 mr-4">
                        Pindai Barcode
                    </a>
                    <a href="{{ route('backoffice.events.create') }}" 
                    class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">
                        Tambah Event
                    </a>
                </div>
            </div><br>
    
            <form method="GET" action="{{ route('backoffice.events.index') }}" class="mb-6">
                <div class="flex gap-2 justify-end">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari event..." 
                        class="w-64 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Cari
                    </button>
                </div>
            </form>

            <div class="flex flex-wrap -mx-3">
                @foreach($events as $event)
                <div class="w-full max-w-full px-3 lg:w-1/3 md:w-1/2 md:flex-none mb-6">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border h-full">
                        {{-- Gambar tipis sebagai header --}}
                        <div class="w-full h-12">
                            <img src="{{ $event->poster_url 
                                ? asset($event->poster_url) 
                                : asset('admin/assets/img/login_design.png') }}" 
                                alt="{{ $event->title }}"
                                class="w-full h-full object-cover rounded-t-2xl">
                        </div>
                
                        {{-- Konten --}}
                        <div class="flex-auto p-4 pt-3 text-center flex flex-col">
                            <h6 class="mb-1 text-slate-800 font-semibold">{{ $event->title }}</h6>
                            <span class="text-xs leading-tight text-gray-500">
                                {{ \Carbon\Carbon::parse($event->datetime_start)->format('d M Y H:i') }} - 
                                {{ \Carbon\Carbon::parse($event->datetime_end)->format('d M Y H:i') }}
                            </span>
                            <hr class="h-px my-3 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
                            <span class="inline-block mb-2 px-2 py-1 text-xs rounded 
                                {{ $event->is_active_event ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $event->is_active_event ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ \Illuminate\Support\Str::limit($event->description, 80) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('backoffice.events.show', $event->id) }}" 
                                class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                @endforeach
            </div>

            <div class="mt-6">
                {{ $events->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
