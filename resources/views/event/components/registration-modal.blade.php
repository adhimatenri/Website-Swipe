<div id="registration-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center z-50 py-16 px-4 overflow-y-auto" x-data="{ open: false }" x-show="open" @open-modal.window="open = true" @close-modal.window="open = false" style="display: none;">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-auto my-8 p-6 sm:p-8 max-h-[80vh] overflow-y-auto" @click.away="open = false">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Daftar Event</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" @click="open = false">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="#" method="POST" @submit.prevent="$dispatch('close-modal'); $dispatch('successful-registration')">
            @csrf
            @include('event.components.form.input', ['label' => 'Nama Lengkap', 'name' => 'name', 'placeholder' => 'John Doe'])
            @include('event.components.form.datepicker', ['label' => 'Tanggal Lahir', 'name' => 'dob'])
            @include('event.components.form.select', ['label' => 'Jenis Kelamin', 'name' => 'gender', 'options' => ['female' => 'Akhwat (Perempuan)', 'male' => 'Ikhwan (Laki-laki)']])
            @include('event.components.form.phone', ['label' => 'No. Whatsapp / Handphone', 'name' => 'phone'])
            @include('event.components.form.input', ['label' => 'Email', 'name' => 'email', 'type' => 'email', 'placeholder' => 'john@doe.com'])
            @include('event.components.form.textarea', ['label' => 'Alamat Lengkap', 'name' => 'address'])
            @include('event.components.form.checkbox', ['label' => 'Saya setuju untuk mematuhi aturan acara', 'name' => 'terms'])
            @include('event.components.form.button', ['label' => 'Kirim Pendaftaran'])
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const termsCheckbox = document.getElementById('terms');
        const submitButton = document.getElementById('submit-button');

        function toggleSubmitButton() {
            submitButton.disabled = !termsCheckbox.checked;
        }

        toggleSubmitButton();

        termsCheckbox.addEventListener('change', toggleSubmitButton);
    });
</script>
