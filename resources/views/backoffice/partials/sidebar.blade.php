<aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
    <div class="h-24 flex justify-center items-center">
        <a class="block text-sm whitespace-nowrap text-slate-700" href="{{ route('backoffice.dashboard') }}">
          <img src="{{ asset('admin/assets/img/logo.png')}}" class="h-16 transition-all duration-200 ease-nav-brand" alt="main_logo" />
        </a>
    </div>
    <hr class="h-px mt-2 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
      <ul class="flex flex-col pl-0 mb-0">
        <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ Request::is('backoffice/dashboard') ? 'bg-blue-500/13 font-semibold' : '' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
               href="{{ route('backoffice.dashboard') }}">
              <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-center xl:p-2.5">
                <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
            </a>
          </li>
          

        <li class="mt-0.5 w-full">
          <a class=" py-2.7 {{ Request::is('backoffice/events*') ? 'bg-blue-500/13 font-semibold' : '' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('backoffice.events.index') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Event</span>
          </a>
        </li>

        <li class="mt-0.5 w-full">
          <a class=" py-2.7 {{ Request::is('backoffice/jamaah*') ? 'bg-blue-500/13 font-semibold' : '' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('backoffice.jamaah.index') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-emerald-500 ni ni-credit-card"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Jamaah</span>
          </a>
        </li>

       

    

        <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ Request::is('backoffice/users*') ? 'bg-blue-500/13 font-semibold' : '' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 text-slate-700 transition-colors"
               href="{{ route('backoffice.users.index') }}">
              <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-center xl:p-2.5">
                <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Pengguna</span>
            </a>
          </li>
          
          

        <li class="mt-0.5 w-full">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
              <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-sm leading-normal text-cyan-500 ni ni-collection"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Keluar</span>
            </a>
        </li>
          
      </ul>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
    
   
  </aside>