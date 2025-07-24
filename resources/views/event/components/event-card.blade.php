<div class="bg-white shadow-lg rounded-lg overflow-hidden w-full flex flex-col h-full">
    <a href="{{ route('events.show', $event->slug) }}">
        <img src="{{ $event->poster_url }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
    </a>
    <div class="p-4 sm:p-6 flex flex-col flex-1">
        <h2 class="font-bold text-xl mb-2">
            <a href="{{ route('events.show', $event->slug) }}" class="hover:text-purple-600">{{ $event->title }}</a>
        </h2>
        <p class="text-gray-700 text-base mb-4">
            {{ Str::limit($event->description, 100) }}
        </p>
        <div class="mt-auto flex flex-col sm:flex-row sm:items-center sm:justify-between justify-center">
            <div class="text-sm text-gray-600 mb-2 sm:mb-0">
                @if($event->is_active_event)
                    <span class="text-green-500"><i class="fas fa-check-circle"></i> {{ $event->max_amount_participants }} Kuota</span>
                @else
                    <span class="text-blue-500"><i class="far fa-calendar-alt"></i> Terjadwal</span>
                @endif
            </div>
            <a href="{{ route('events.show', $event->slug) }}" class="mt-2 sm:mt-0 bg-purple-500 text-white font-bold py-2 px-4 rounded hover:bg-purple-600 text-center">
                Lihat
            </a>
        </div>
    </div>
</div>
