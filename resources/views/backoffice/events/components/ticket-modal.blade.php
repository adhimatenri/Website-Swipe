<div id="ticketModal" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); 
      display: flex; align-items: center; justify-content: center; z-index: 9999;">
  <div style="background: white; padding: 2rem; border-radius: 0.75rem; width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
    <h3 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem; text-align: center; color: #334155;">Informasi Tiket</h3>
    
    <div style="margin-bottom: 1rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem 3rem;">
      <div>
        <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Event</p>
        <p style="color: #334155; margin: 0;" id="eventTitle"></p>
      </div>
      
      <div>
        <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Waktu</p>
        <p style="color: #334155; margin: 0;" id="eventTime"></p>
      </div>
      
      <div>
        <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Tanggal Mulai Event</p>
        <p style="color: #334155; margin: 0;" id="eventDateStart"></p>
      </div>
      
      <div>
        <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Tanggal Akhir Event</p>
        <p style="color: #334155; margin: 0;" id="eventDateEnd"></p>
      </div>
    </div>
    
    <hr style="margin: 1.5rem 0; border: 0; height: 1px; background-color: #e2e8f0;">
    
    <div style="margin-bottom: 1rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem 3rem;">
      <div>
        <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Nama Lengkap</p>
        <p style="color: #334155; margin: 0;" id="jamaahName"></p>
      </div>
      <div>
        <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Tanggal Lahir</p>
        <p style="color: #334155; margin: 0;" id="jamaahDob"></p>
      </div>
      
      <div>
        <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">No. Whatsapp / Handphone</p>
        <p style="color: #334155; margin: 0;" id="jamaahPhone"></p>
      </div>
      <div>
        <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Email</p>
        <p style="color: #334155; margin: 0;" id="jamaahEmail"></p>
      </div>
      
      <div style="grid-column: span 2;">
        <p style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem;">Alamat Lengkap</p>
        <p style="color: #334155; margin: 0;" id="jamaahAddress"></p>
      </div>
    </div>
    
    <div id="buttonsContainer" style="display: flex; justify-content: flex-end; margin-top: 2rem;">
      <button id="confirmBtn" style="background: #FFCA28; padding: 0.75rem 2rem; border-radius: 0.5rem; font-weight: 600; color: #333; border: none; cursor: pointer;">Konfirmasi</button>
      <button id="cancelBtn" style="background: #E2E8F0; padding: 0.75rem 2rem; border-radius: 0.5rem; font-weight: 600; color: #333; margin-left: 0.75rem; border: none; cursor: pointer;">Batal</button>
    </div>
  </div>
</div>