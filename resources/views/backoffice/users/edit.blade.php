@extends('backoffice.layouts.app')
@section('title', 'Edit Pengguna')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mb-6 mx-auto">
      <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
          <h6 class="mb-0 font-bold">Edit Pengguna</h6>
        </div>
        <div class="flex-auto p-6">
          <form action="{{ route('backoffice.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
              <label for="name" class="block mb-2 text-sm font-bold text-slate-700">Nama</label>
              <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                     class="form-input block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="email" class="block mb-2 text-sm font-bold text-slate-700">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                     class="form-input block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="password" class="block mb-2 text-sm font-bold text-slate-700">Password Baru (Opsional)</label>
              <input type="password" id="password" name="password"
                     class="form-input block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="password_confirmation" class="block mb-2 text-sm font-bold text-slate-700">Konfirmasi Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation"
                     class="form-input block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
              <label for="role_id" class="block mb-2 text-sm font-bold text-slate-700">Role</label>
              <select id="role_id" name="role_id" required
                      class="form-select block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                @foreach($roles as $id => $name)
                  <option value="{{ $id }}" {{ $user->role_id == $id ? 'selected' : '' }}>
                    {{ $name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="mb-4">
                <label for="phone" class="block mb-2 text-sm font-bold text-slate-700">No. Telepon</label>
                <input type="text" class="form-input block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
              </div>
              
            <div class="mb-4">
                <label for="gender" class="block mb-2 text-sm font-bold text-slate-700">Jenis Kelamin</label>
                <select name="gender" class="form-select block w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                  <option value="">Pilih</option>
                  <option value="Laki-laki" {{ (old('gender', $user->gender ?? '') == 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan" {{ (old('gender', $user->gender ?? '') == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
                </select>
             </div>
              

            <div class="flex justify-end mt-6">
              <button type="submit"
                      class="inline-block px-6 py-2 text-sm font-semibold text-white uppercase transition-all duration-150 ease-in bg-blue-500 rounded-lg shadow-md hover:bg-blue-600">
                Perbarui
              </button>
              <a href="{{ route('backoffice.users.index') }}"
                 class="ml-4 inline-block px-6 py-2 text-sm font-semibold text-slate-700 uppercase transition-all duration-150 ease-in bg-gray-200 rounded-lg hover:bg-gray-300">
                Batal
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
