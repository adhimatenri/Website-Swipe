@extends('event.layout')

@section('title', 'Temukan Kajian & Kegiatan Islami Terbaru')

@section('content')
<div class="text-center mb-12">
    <h1 class="text-4xl font-bold text-gray-800">Assalamu'alaikum!</h1>
    <p class="text-xl text-gray-600 mt-2">Temukan Kajian & Kegiatan Islami Terbaru Swipe Disini!</p>
</div>

<div class="grid md:grid-cols-3 gap-8">
    @foreach($events as $event)
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <a href="{{ route('events.show', $event->slug) }}">
            <img src="{{ $event->poster_url }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
        </a>
        <div class="p-6">
            <h2 class="font-bold text-xl mb-2">
                <a href="{{ route('events.show', $event->slug) }}" class="hover:text-purple-600">{{ $event->title }}</a>
            </h2>
            <p class="text-gray-700 text-base mb-4">
                {{ Str::limit($event->description, 100) }}
            </p>
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    @if($event->is_active_event)
                        <span class="text-green-500"><i class="fas fa-check-circle"></i> {{ $event->max_amount_participants }} Kuota</span>
                    @else
                        <span class="text-blue-500"><i class="far fa-calendar-alt"></i> Terjadwal</span>
                    @endif
                </div>
                <a href="{{ route('events.show', $event->slug) }}" class="bg-purple-500 text-white font-bold py-2 px-4 rounded hover:bg-purple-600">
                    Lihat
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
