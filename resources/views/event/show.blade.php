@extends('event.layout')

@section('title', $event->title)

@section('content')
<div class="bg-white shadow-lg rounded-lg overflow-hidden max-w-4xl mx-auto">
    <div class="p-8">
        <div class="bg-purple-200 rounded-lg p-8 mb-8 text-center" style="background-image: url('{{ $event->poster_url }}'); background-size: cover; background-position: center;">
            <div class="bg-black bg-opacity-20 p-8 rounded-lg">
                <h1 class="text-4xl font-bold text-white mb-2">{{ $event->title }}</h1>
                <p class="text-2xl text-white">{{ $event->subtitle }}</p>
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#" class="bg-yellow-400 text-gray-900 font-bold py-3 px-6 rounded-lg hover:bg-yellow-500">Daftar Sekarang</a>
                    <a href="#jadwal" class="bg-white text-gray-900 font-bold py-3 px-6 rounded-lg hover:bg-gray-200">Lihat Jadwal</a>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi Acara</h2>
            <div class="text-gray-700 space-y-4">
                {!! $event->description !!}
            </div>
        </div>

        <div id="jadwal" class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Kapan & Dimana?</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <div class="flex items-start">
                        <div class="text-2xl text-gray-600 mr-4"><i class="far fa-calendar-alt"></i></div>
                        <div>
                            <h3 class="font-bold text-lg">Jadwal Kajian</h3>
                            <p class="text-gray-700">Tanggal & Waktu: {{ $event->datetime_start->format('d F Y') }} - {{ $event->datetime_end->format('d F Y') }}, {{ $event->datetime_start->format('H:i') }} WIB</p>
                        </div>
                    </div>
                    <div class="flex items-start mt-4">
                        <div class="text-2xl text-gray-600 mr-4"><i class="far fa-map-marker-alt"></i></div>
                        <div>
                            <h3 class="font-bold text-lg">Lokasi</h3>
                            <p class="text-gray-700">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="rounded-lg overflow-hidden h-64">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.835439238265!2d106.83018381477086!3d-6.54247999526922!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c3d32d5f3c3b%3A0x3b5f5a3a5b5b5b5b!2sVivo%20Mall%20Bogor!5e0!3m2!1sen!2sid!4v1627000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">FAQ</h2>
            <div class="space-y-4">
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-bold">Apa itu Swipe - Hentakan Hijrah?</h3>
                    <p class="text-gray-700 mt-2">Swipe - Hentakan Hijrah adalah komunitas online yang menyelenggarakan kajian dan khutbah Islam dengan menghadirkan para ulama terkemuka.</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-bold">Bagaimana cara mendaftar?</h3>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-bold">Apakah ada biaya pendaftaran?</h3>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-bold">Boleh ajak teman untuk ikut?</h3>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-bold">Bagaimana akses ke lokasi?</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
