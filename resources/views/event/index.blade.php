@extends('event.layout')

@section('title', 'Temukan Kajian & Kegiatan Islami Terbaru')

@section('content')
<div class="text-center mb-12">
    <h1 class="text-4xl font-bold text-gray-800">Assalamu'alaikum!</h1>
    <p class="text-xl text-gray-600 mt-2">Temukan Kajian & Kegiatan Islami Terbaru Swipe Disini!</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($events as $event)
        @include('event.components.event-card', ['event' => $event])
    @endforeach
</div>
@endsection
