<div id="successful-registration-modal" 
     class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center z-50 py-16 px-4 overflow-y-auto" 
     x-data="{ open: false, registrationId: null }" 
     x-show="open" 
     @successful-registration.window="
        open = true; 
        registrationId = $event.detail.registrationId;
        $store.qrcode.loadQrCode(registrationId);
     " 
     style="display: none;">
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
            <div class="w-60 h-60 mx-auto flex items-center justify-center rounded-lg bg-gray-100" 
                 x-show="$store.qrcode.loading">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-600"></div>
            </div>
            
            <div class="w-60 h-60 bg-gray-800 mx-auto flex items-center justify-center rounded-lg" 
                 x-show="!registrationId && !$store.qrcode.loading">
                <i class="far fa-qrcode text-white text-6xl"></i>
            </div>
            
            <div class="w-60 h-60 mx-auto flex items-center justify-center rounded-lg bg-white border-2 border-gray-200 p-2" 
                 x-show="registrationId && !$store.qrcode.loading" 
                 x-html="$store.qrcode.svg">
            </div>
            
            <p class="text-gray-600 mt-4">Tunjukkan kode QR ini saat masuk ke Acara</p>
        </div>

        <div class="space-y-4">
            @include('event.components.form.button', ['label' => 'Unduh Tiket', 'href' => '#', 'variant' => 'primary'])
            @include('event.components.form.button', ['label' => 'Kembali ke Beranda', 'href' => route('events.index'), 'variant' => 'secondary'])
        </div>
        <p class="text-xs text-gray-500 mt-6">Email berisi tiket dan detail acara juga sudah dikirim.<br>Periksa kotak masuk atau spam.</p>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('qrcode', {
        svg: '',
        loading: false,
        
        async loadQrCode(registrationId) {
            this.loading = true;
            try {
                const response = await fetch('/event/registration/qrcode', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        registrationId: registrationId
                    })
                });
                
                if (response.ok) {
                    let svgContent = await response.text();
                    
                    if (svgContent.startsWith('data:image/svg+xml;base64,')) {
                        const base64Data = svgContent.split(',')[1];
                        svgContent = atob(base64Data);
                    } else if (svgContent.includes('base64,')) {
                        const base64Data = svgContent.split('base64,')[1];
                        svgContent = atob(base64Data);
                    }
                    
                    if (svgContent.includes('<svg')) {
                        svgContent = svgContent.replace(
                            /<svg([^>]*)>/,
                            '<svg$1 class="w-full h-full" preserveAspectRatio="xMidYMid meet">'
                        );
                    }
                    
                    this.svg = svgContent;
                } else {
                    console.error('Failed to load QR code');
                    this.svg = '<p class="text-red-500 text-sm">Failed to load QR code</p>';
                }
            } catch (error) {
                console.error('Error loading QR code:', error);
                this.svg = '<p class="text-red-500 text-sm">Error loading QR code</p>';
            } finally {
                this.loading = false;
            }
        }
    });
});
</script>
