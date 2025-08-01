@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('video');
    const modalsContainer = document.getElementById('modals');
    let scanInterval = null;
    let currentRegistrationId = null;

    window.stopScanning = function() {
      if (scanInterval) {
        clearInterval(scanInterval);
        scanInterval = null;
        console.log("Scanning stopped");
      }
    }

    window.startScanning = function() {
      if (scanInterval) return;
      console.log("Starting scan interval...");
      
      scanInterval = setInterval(async () => {
        if (!video) {
          console.error("Video element not found");
          return;
        }
        
        if (video.readyState !== 4) {
          console.log("Video not ready yet");
          return;
        }
        
        if (document.querySelector('#ticketModal') || document.querySelector('#successModal')) {
          console.log("Modal active, pausing scan");
          return;
        }

        try {
          console.log("Capturing frame...");
          const canvas = document.createElement('canvas');
          canvas.width = video.videoWidth;
          canvas.height = video.videoHeight;
          const ctx = canvas.getContext('2d');
          ctx.drawImage(video, 0, 0);
          const dataURL = canvas.toDataURL('image/png');

          console.log("Sending to decode API...");
          const res = await fetch("{{ route('backoffice.events.decode') }}", {
            method: 'POST',
            headers: { 
              'Content-Type': 'application/json', 
              'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify({ image: dataURL })
          });
          
          const payload = await res.json();
          console.log("Scan result:", payload);

          if (res.ok && payload.status === 'success') {
            window.stopScanning();
            window.showTicketModal(payload);
          } else if (payload.status === 'error') {
            console.error('Scan error:', payload.message);
          }
        } catch (error) {
          console.error('Decode fetch error:', error);
        }
      }, 2000);
      
      console.log("Scan interval started");
    }

    window.showTicketModal = function(data) {
      console.log("Showing modal with data:", data);
      currentRegistrationId = data.registrationId;
      
      try {
        fetch("{{ route('backoffice.events.components.ticket-modal') }}")
          .then(response => {
            if (!response.ok) {
              throw new Error(`Modal fetch failed: ${response.status} ${response.statusText}`);
            }
            return response.text();
          })
          .then(html => {
            modalsContainer.innerHTML = html;
            
            const eventDateStart = new Date(data.eventDetails.eventStart.date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});
            const eventDateEnd = new Date(data.eventDetails.eventEnd.date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});
            const birthDate = new Date(data.jamaahDetails.jamaahDob).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});
            
            document.getElementById('eventTitle').textContent = data.eventDetails.eventTitle;
            document.getElementById('eventTime').textContent = `${data.eventDetails.eventStart.time}-${data.eventDetails.eventEnd.time}`;
            document.getElementById('eventDateStart').textContent = eventDateStart;
            document.getElementById('eventDateEnd').textContent = eventDateEnd;
            document.getElementById('jamaahName').textContent = data.jamaahDetails.jamaahName;
            document.getElementById('jamaahDob').textContent = birthDate;
            document.getElementById('jamaahPhone').textContent = data.jamaahDetails.jamaahPhone;
            document.getElementById('jamaahEmail').textContent = data.jamaahDetails.jamaahEmail || 'Tidak tersedia';
            document.getElementById('jamaahAddress').textContent = data.jamaahDetails.jamaahAddress;
            
            document.getElementById('confirmBtn').onclick = () => window.confirmAttendance(data.registrationId);
            document.getElementById('cancelBtn').onclick = () => {
                modalsContainer.innerHTML = '';
                window.startScanning();
            };
          })
          .catch(error => {
            console.error("Error fetching modal:", error);
            alert("Error loading ticket info: " + error.message);
          });
      } catch (e) {
        console.error("Error rendering ticket modal:", e);
        alert("Error details: " + e.message);
      }
    }

    window.confirmAttendance = async function(registrationId) {
      try {
        const buttonsContainer = document.getElementById('buttonsContainer');
        buttonsContainer.innerHTML = `
          <div style="display: flex; justify-content: center; width: 100%;">
            <div style="display: flex; align-items: center;">
              <div style="border: 4px solid #f3f3f3; border-top: 4px solid #FFCA28; border-radius: 50%; width: 30px; height: 30px; animation: spin 1s linear infinite; margin-right: 10px;"></div>
              <span style="font-size: 0.875rem; color: #334155;">Memproses...</span>
            </div>
          </div>
          <style>
            @keyframes spin {
              0% { transform: rotate(0deg); }
              100% { transform: rotate(360deg); }
            }
          </style>
        `;
        
        const res = await fetch("{{ route('backoffice.events.confirm') }}", {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          body: JSON.stringify({ registrationId: registrationId })
        });
        
        const payload = await res.json();
        console.log("Confirmation result:", payload);
        
        if (res.ok && payload.status === 'success') {
          window.showSuccessModal();
        } else {
          alert('Konfirmasi gagal: ' + (payload.message || 'Unknown error'));
          buttonsContainer.innerHTML = `
            <button id="confirmBtn" style="background: #FFCA28; padding: 0.75rem 2rem; border-radius: 0.5rem; font-weight: 600; color: #333; border: none; cursor: pointer;">Konfirmasi</button>
            <button id="cancelBtn" style="background: #E2E8F0; padding: 0.75rem 2rem; border-radius: 0.5rem; font-weight: 600; color: #333; margin-left: 0.75rem; border: none; cursor: pointer;">Batal</button>
          `;
          document.getElementById('confirmBtn').onclick = () => window.confirmAttendance(registrationId);
          document.getElementById('cancelBtn').onclick = () => {
              modalsContainer.innerHTML = '';
              window.startScanning();
          };
        }
      } catch (error) {
        console.error('Confirm error:', error);
        alert('Terjadi kesalahan saat konfirmasi.');
      }
    }

    window.showSuccessModal = function() {
      fetch("{{ route('backoffice.events.components.success-modal') }}")
        .then(response => {
          if (!response.ok) {
            throw new Error(`Modal fetch failed: ${response.status} ${response.statusText}`);
          }
          return response.text();
        })
        .then(html => {
          modalsContainer.innerHTML = html;
          document.getElementById('okBtn').onclick = () => {
            modalsContainer.innerHTML = '';
            window.startScanning();
          };
        })
        .catch(error => {
          console.error("Error fetching success modal:", error);
          alert("Error showing success: " + error.message);
        });
    }
  });
</script>
@endpush