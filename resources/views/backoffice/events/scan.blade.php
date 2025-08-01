@extends('backoffice.layouts.app')

@section('breadcrumb', 'Pindai Barcode')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
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

  <div id="modals"></div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('video');
    const modalsContainer = document.getElementById('modals');
    let scanInterval = null;

    function stopScanning() {
      if (scanInterval) {
        clearInterval(scanInterval);
        scanInterval = null;
      }
    }

    function startScanning() {
      if (scanInterval) return;
      scanInterval = setInterval(async () => {
        if (!video || video.readyState !== 4 || document.querySelector('.modal-card')) return;

        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        const dataURL = canvas.toDataURL('image/png');

        try {
          const res = await fetch("{{ route('backoffice.events.decode') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ image: dataURL })
          });
          const payload = await res.json();
          console.log("Scan result:", payload);

          if (res.ok && payload.status === 'success') {
            stopScanning();
            showTicketModal(payload);
          } else if (payload.status === 'error') {
            stopScanning();
            alert('Gagal: ' + payload.message);
            setTimeout(() => startScanning(), 3000);
          }
        } catch (error) {
          console.error('Decode fetch error:', error);
        }
      }, 2000);
    }

    function showTicketModal(data) {
      console.log("Showing modal with data:", data);
      
      try {
        const eventDateStart = new Date(data.eventDetails.eventStart.date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});
        const eventDateEnd = new Date(data.eventDetails.eventEnd.date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});
        const birthDate = new Date(data.jamaahDetails.jamaahDob).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});
        
        const modalHtml = `
          <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); 
                display: flex; align-items: center; justify-content: center; z-index: 9999;">
            <div style="background: white; padding: 2rem; border-radius: 0.75rem; width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
              <h3 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem; text-align: center; color: #334155;">Informasi Tiket</h3>
              
              <div style="margin-bottom: 1rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem 3rem;">
                <div>
                  <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Event</p>
                  <p style="color: #334155; margin: 0;">${data.eventDetails.eventTitle}</p>
                </div>
                
                <div>
                  <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Waktu</p>
                  <p style="color: #334155; margin: 0;">${data.eventDetails.eventStart.time}-${data.eventDetails.eventEnd.time}</p>
                </div>
                
                <div>
                  <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Tanggal Mulai Event</p>
                  <p style="color: #334155; margin: 0;">${eventDateStart}</p>
                </div>
                
                <div>
                  <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Tanggal Akhir Event</p>
                  <p style="color: #334155; margin: 0;">${eventDateEnd}</p>
                </div>
              </div>
              
              <hr style="margin: 1.5rem 0; border: 0; height: 1px; background-color: #e2e8f0;">
              
              <div style="margin-bottom: 1rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem 3rem;">
                <div>
                  <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Nama Lengkap</p>
                  <p style="color: #334155; margin: 0;">${data.jamaahDetails.jamaahName}</p>
                </div>
                <div>
                  <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Tanggal Lahir</p>
                  <p style="color: #334155; margin: 0;">${birthDate}</p>
                </div>
                
                <div>
                  <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">No. Whatsapp / Handphone</p>
                  <p style="color: #334155; margin: 0;">${data.jamaahDetails.jamaahPhone}</p>
                </div>
                <div>
                  <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Email</p>
                  <p style="color: #334155; margin: 0;">${data.jamaahDetails.jamaahEmail || 'Tidak tersedia'}</p>
                </div>
                
                <div style="grid-column: span 2;">
                  <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Alamat Lengkap</p>
                  <p style="color: #334155; margin: 0;">${data.jamaahDetails.jamaahAddress}</p>
                </div>
              </div>
              
              <div style="display: flex; justify-content: flex-end; margin-top: 2rem;">
                <button id="confirmBtn" style="background: #FFCA28; padding: 0.75rem 2rem; border-radius: 0.5rem; font-weight: 600; color: #333; border: none; cursor: pointer;">Konfirmasi</button>
                <button id="cancelBtn" style="background: #E2E8F0; padding: 0.75rem 2rem; border-radius: 0.5rem; font-weight: 600; color: #333; margin-left: 0.75rem; border: none; cursor: pointer;">Batal</button>
              </div>
            </div>
          </div>`;
        
        modalsContainer.innerHTML = modalHtml;
        
        document.getElementById('confirmBtn').onclick = () => confirmAttendance(data.registrationId);
        document.getElementById('cancelBtn').onclick = () => {
            modalsContainer.innerHTML = '';
            startScanning();
        };
      } catch (e) {
        console.error("Error rendering ticket modal:", e);
        alert("Error details: " + e.message);
      }
    }

    async function confirmAttendance(registrationId) {
      try {
        const res = await fetch("{{ route('backoffice.events.confirm') }}", {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          body: JSON.stringify({ registrationId: registrationId })
        });
        const payload = await res.json();
        if (res.ok && payload.status === 'success') {
          showSuccessModal();
        } else {
          alert('Konfirmasi gagal: ' + (payload.message || 'Unknown error'));
        }
      } catch (error) {
        console.error('Confirm error:', error);
        alert('Terjadi kesalahan saat konfirmasi.');
      }
    }

    function showSuccessModal() {
      const modalHtml = `
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
          <div class="modal-card bg-white p-8 rounded-2xl shadow-lg max-w-sm w-full text-center animate-fade-in-up">
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-4">
              <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Check In Berhasil</h3>
            <p class="text-slate-500 mb-6">Kehadiran telah dicatat</p>
            <button id="okBtn" class="w-full px-8 py-3 bg-yellow-400 text-slate-800 font-semibold rounded-lg shadow-md hover:bg-yellow-500">Oke</button>
          </div>
        </div>`;
      modalsContainer.innerHTML = modalHtml;
      document.getElementById('okBtn').onclick = () => {
        modalsContainer.innerHTML = '';
        startScanning();
      };
    }

    navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' }, audio: false })
      .then(stream => {
        video.srcObject = stream;
        video.play();
        startScanning();
      })
      .catch(error => {
        console.error("Camera error:", error);
        alert("Tidak dapat mengakses kamera. Pastikan Anda telah memberikan izin.");
      });
  });
</script>
@endpush
