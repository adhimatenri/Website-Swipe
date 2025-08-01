<div>
  <h3 class="text-xl font-semibold mb-4">Pindai Barcode</h3>
  <p class="text-sm text-gray-600 mb-6">Gunakan handphone agar proses lebih efektif</p>

  <div class="bg-white rounded-lg p-4 shadow">
    <video 
      id="video"
      autoplay
      muted
      playsinline
      class="w-full h-64 rounded bg-gray-100"
    ></video>
  </div>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    window.initScanner = function() {
      const video = document.getElementById('video');
      
      navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' }, audio: false })
        .then(stream => {
          video.srcObject = stream;
          video.play();
          window.startScanning();
        })
        .catch(error => {
          console.error("Camera error:", error);
          alert("Tidak dapat mengakses kamera. Pastikan Anda telah memberikan izin.");
        });
    };
    
    setTimeout(() => {
      if (typeof window.scannerInitialized === 'undefined') {
        window.scannerInitialized = true;
        window.initScanner();
      }
    }, 500);
  });
</script>
@endpush