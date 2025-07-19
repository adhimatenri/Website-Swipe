
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets/img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{ asset('admin/assets/img/favicon.png')}}" />
    <title>Management Event Swipe</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2'"></script>
    <!-- Main Styling -->
    <link href="{{ asset('admin/assets/css/argon-dashboard-tailwind.css?v=1.0.1')}}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        table.dataTable thead th {
          @apply border-b bg-gray-100 text-xs font-bold uppercase text-slate-500 px-4 py-2;
        }
      
        table.dataTable tbody td {
          @apply px-4 py-2 text-slate-600;
        }
      
        .dataTables_wrapper .dataTables_paginate .paginate_button {
          @apply px-2 py-1 rounded-md border text-sm hover:bg-blue-100;
        }
      
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
          @apply border rounded px-2 py-1 text-sm;
        }
      
        .dataTables_wrapper .dataTables_info {
          @apply text-sm mt-2;
        }
      </style>
      
  </head>

  <body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
    <!-- sidenav  -->
     @include('backoffice.partials.sidebar')


    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
      <!-- Navbar -->
      @include('backoffice.partials.navbar')

      <!-- end Navbar -->
      <div class="w-full px-6 py-6 mx-auto">
        @yield('content')

         @include('backoffice.partials.footer')
      </div>
    </main>
   
  </body>
  <!-- plugin for charts  -->
  <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js')}}" async></script>
  <!-- plugin for scrollbar  -->
  <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js')}}" async></script>
  <!-- main script file  -->
  <script src="{{ asset('admin/assets/js/argon-dashboard-tailwind.js?v=1.0.1')}}" async></script>
<<<<<<< HEAD
=======
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

  @stack('scripts')
>>>>>>> e0e4cbf5f5f06cce6fee7d7e5c1d3240f4cbd241
</html>
