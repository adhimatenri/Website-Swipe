<div id="successful-registration-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center z-50 py-16 px-4 overflow-y-auto" x-data="{ open: false, registrationId: null }" x-show="open" @successful-registration.window="open = true; registrationId = $event.detail.registrationId" style="display: none;">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-auto my-8 p-6 sm:p-8 text-center" @click.away="open = false">
        <div class="mb-6">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100">
                <svg class="h-16 w-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mt-6">Pendaftaran Berhasil!</h3>
            <p class="text-gray-600 mt-2">Terima kasih telah mendaftar. Detail acara Anda tersedia di bawah ini.</p>
        </div>

        <div class="text-left border-t border-b py-6 my-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="far fa-map-marker-alt text-gray-500 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Lokasi</p>
                            <p class="font-semibold">{{ $event->location }}</p>
                        </div>
                    </div>
                    <div class="flex items-center mb-4">
                        <i class="far fa-clock text-gray-500 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Waktu</p>
                            <p class="font-semibold">{{ $event->datetime_start->format('H:i') }} - {{ $event->datetime_end->format('H:i') }} WIB</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-calendar-alt text-gray-500 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal</p>
                            <p class="font-semibold">{{ $event->datetime_start->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center mb-4">
                        <i class="far fa-envelope text-gray-500 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-semibold">fulan@if.uai.ac.id</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-user text-gray-500 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-500">Nama Peserta</p>
                            <p class="font-semibold">Fulan Bin Fulan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <div class="w-40 h-40 bg-gray-800 mx-auto flex items-center justify-center rounded-lg">
                <i class="far fa-qrcode text-white text-6xl"></i>
            </div>
            <p class="text-gray-600 mt-4">Tunjukkan kode QR ini saat masuk ke Acara</p>
        </div>

        <div class="space-y-4">
            @include('event.components.form.button', ['label' => 'Unduh Tiket', 'href' => '#', 'variant' => 'primary'])
            @include('event.components.form.button', ['label' => 'Kembali ke Beranda', 'href' => route('events.index'), 'variant' => 'secondary'])
        </div>
        <p class="text-xs text-gray-500 mt-6">Email berisi tiket dan detail acara juga sudah dikirim. Periksa kotak masuk atau spam.</p>
    </div>
</div>
