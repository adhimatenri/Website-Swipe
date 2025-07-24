<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('admin/assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
</head>
<body style="background-color: #faf4dc;" class="m-0 font-sans antialiased font-normal text-start text-base leading-default text-slate-500">

  <main class="mt-0 transition-all duration-200 ease-in-out">
    <section>
      <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover">
        <div class="container z-1">
          <div class="flex flex-wrap -mx-3">
            <div class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
              <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 rounded-2xl bg-clip-border">

                <div class="p-6 pb-0 mb-0">
                  <h4 class="font-bold">Selamat Datang</h4>
                  <p class="mb-0">Silahkan Masuk Ke Dashboard Admin</p>
                </div>

                <div class="flex-auto p-6">

                  {{-- Session Status --}}
                  @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                      {{ session('status') }}
                    </div>
                  @endif

                  <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                      <input id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}"
                        required autofocus autocomplete="username"
                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white p-3 font-normal text-gray-700 placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                      @error('email')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                      @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                      <input id="password" name="password" type="password" placeholder="Password"
                        required autocomplete="current-password"
                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white p-3 font-normal text-gray-700 placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                      @error('password')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                      @enderror
                    </div>

                    {{-- Remember me --}}
                    <div class="flex items-center pl-2 mb-2">
                      <input id="remember_me" name="remember" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                      <label for="remember_me" class="ml-2 text-sm text-slate-700">Remember me</label>
                    </div>

                    {{-- Forgot password --}}
                    <div class="flex justify-end">
                      @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900">
                          Lupa password?
                        </a>
                      @endif
                    </div>

                    {{-- Submit --}}
                    <div class="text-center">
                      <button type="submit"
                        class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold text-white bg-blue-500 border-0 rounded-lg shadow-md hover:-translate-y-px hover:shadow-xs active:opacity-85 text-sm transition-all">
                        Sign in
                      </button>
                    </div>
                  </form>
                </div>

              </div>
            </div>

            {{-- Right Image --}}
            <div class="absolute top-0 right-0 hidden w-6/12 h-full max-w-full px-3 pr-0 my-auto text-center lg:flex flex-col justify-center">
              <div class="relative flex flex-col justify-center h-full bg-no-repeat bg-center px-24 m-4 overflow-hidden rounded-xl" 
                   style="background-image: url('{{ asset('admin/assets/img/logo_swipe.png') }}'); 
                          background-color: #fffbea;
                          background-size: cover;
                          background-repeat: no-repeat;
                          background-position: center;">
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>

</body>
</html>
