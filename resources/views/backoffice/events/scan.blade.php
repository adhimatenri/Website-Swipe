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
      if (video.readyState !== 4 || document.querySelector('.modal-card')) return;

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

        if (res.ok && payload.status === 'success') {
          stopScanning();
          showTicketModal(payload);
        } else if (!res.ok) {
          alert('Error: ' + (payload.error || payload.message || 'Unknown error'));
          setTimeout(startScanning, 3000);
        }
      } catch (error) {
        console.error('Decode error:', error);
      }
    }, 2000);
  }

  function showTicketModal(data) {
    const eventDate = new Date(data.eventDetails.eventStart.date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    const birthDate = new Date(data.jamaahDetails.jamaahDob).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });

    const modalHtml = `
      <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="modal-card bg-white p-8 rounded-2xl shadow-lg max-w-2xl w-full">
          <h3 class="text-2xl font-bold text-center mb-6 text-slate-700">Informasi Tiket</h3>
          <div class="grid grid-cols-2 gap-x-12 gap-y-4 text-slate-700 mb-8">
            <div><p class="text-sm font-semibold">Event</p><p>${data.eventDetails.eventTitle}</p></div>
            <div class="grid grid-cols-2">
              <div><p class="text-sm font-semibold">Tanggal Event</p><p>${eventDate}</p></div>
              <div><p class="text-sm font-semibold">Waktu</p><p>${data.eventDetails.eventStart.time} - ${data.eventDetails.eventEnd.time}</p></div>
            </div>
          </div>
          <hr class="my-6">
          <div class="grid grid-cols-2 gap-x-12 gap-y-4 text-slate-700 mb-8">
            <div><p class="text-sm font-semibold">Nama Lengkap</p><p>${data.jamaahDetails.jamaahName}</p></div>
            <div><p class="text-sm font-semibold">Tanggal Lahir</p><p>${birthDate}</p></div>
            <div><p class="text-sm font-semibold">No. Whatsapp / Handphone</p><p>${data.jamaahDetails.jamaahPhone}</p></div>
            <div><p class="text-sm font-semibold">Email</p><p>${data.jamaahDetails.jamaahEmail ?? 'Tidak tersedia'}</p></div>
            <div class="col-span-2"><p class="text-sm font-semibold">Alamat Lengkap</p><p>${data.jamaahDetails.jamaahAddress}</p></div>
          </div>
          <div class="flex justify-end">
            <button id="confirmBtn" class="px-8 py-3 bg-yellow-400 text-slate-800 font-semibold rounded-lg shadow-md hover:bg-yellow-500">Konfirmasi</button>
            <button id="cancelBtn" class="ml-4 px-8 py-3 bg-gray-200 text-slate-800 font-semibold rounded-lg hover:bg-gray-300">Batal</button>
          </div>
        </div>
      </div>`;
    modalsContainer.innerHTML = modalHtml;
    document.getElementById('confirmBtn').onclick = () => confirmAttendance(data.registrationId);
    document.getElementById('cancelBtn').onclick = () => {
        modalsContainer.innerHTML = '';
        startScanning();
    };
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
        <div class="modal-card bg-white p-8 rounded-2xl shadow-lg max-w-sm w-full text-center">
          <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-4">
            <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
          </div>
          <h3 class="text-2xl font-bold text-slate-800 mb-2">Check In Berhasil</h3>
          <p class="text-slate-500 mb-6">Kehadiran telah dicatat</p>
          <button id="okBtn" class="w-full px-8 py-3 bg-yellow-400 text-slate-800 font-semibold rounded-lg shadow-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-75">Oke</button>
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
</script>
@endpush
