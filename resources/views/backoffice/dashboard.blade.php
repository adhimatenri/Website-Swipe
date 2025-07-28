@extends('backoffice.layouts.app')

@section('content')
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                        <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Event Berlangsung</p>
                        <h5 class="mb-2 font-bold dark:text-white">{{ $eventBerlangsung }}</h5>
                    
                    </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                        <i class="ni leading-none ni-send text-lg relative top-3.5 text-white"></i>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Event Selesai</p>
                    <h5 class="mb-2 font-bold dark:text-white">{{ $eventSelesai }}</h5>
                    
                </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                    <i class="ni leading-none ni-tag text-lg relative top-3.5 text-white"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Jumlah Event</p>
                    <h5 class="mb-2 font-bold dark:text-white">{{ $totalEvent }}</h5>
                   
                </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                    <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- card4 -->
        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Jumlah Jamaah</p>
                    <h5 class="mb-2 font-bold dark:text-white">{{ $jumlahJamaah }}</h5>
                   
                </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                    <i class="ni leading-none ni-istanbul text-lg relative top-3.5 text-white"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- cards row 2 -->
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
            <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="flex justify-between items-center p-4">
                    <h6 class="capitalize dark:text-white">Jumlah Yang Sudah Selesai</h6>
                    <select id="yearFilter" class="border rounded px-2 py-1 text-sm">
                        @for ($y = now()->year; $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <canvas id="eventBarChart" height="300"></canvas>
            </div>
        </div>
        <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none mt-0">
            <div class="border border-gray-200 shadow-md dark:bg-slate-850 dark:shadow-dark-xl flex flex-col rounded-2xl bg-white h-full">
                <!-- Header -->
                <div class="p-4 border-b border-gray-200 bg-gray-50 rounded-t-2xl">
                    <h6 class="text-base font-bold text-slate-800 dark:text-white">Event Yang Akan Berlangsung</h6>
                </div>
        
                <!-- List -->
                <div class="p-3 space-y-2 overflow-y-auto" style="max-height: 320px;"> 
                    @forelse ($upcomingEvents as $event)
                        <div class="flex items-center justify-between p-2 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-8 h-8 rounded-md bg-indigo-100">
                                    <i class="ni ni-calendar-grid-58 text-indigo-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-800 dark:text-white leading-tight">{{ $event->title }}</p>
                                    <p class="text-xs text-gray-500 leading-tight">
                                        {{ \Carbon\Carbon::parse($event->datetime_start)->format('d M Y') }},
                                        {{ $event->max_amount_participants }} Jamaah
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('events.show', $event->slug) }}" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 text-sm">Belum ada event</p>
                    @endforelse
                </div>
            </div>
        </div> 
    </div>

  <!-- cards row 3 -->
  <div class="flex flex-wrap mt-6 -mx-3">
    <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
        <div class="flex items-center justify-between p-6 bg-white shadow-xl rounded-2xl dark:bg-slate-850">
            <div>
                <div class="flex items-center mb-2">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-gradient-to-tl from-blue-500 to-cyan-400 text-white">
                        <i class="ni ni-bullet-list-67 text-lg"></i>
                    </div>
                    <h6 class="ml-3 text-sm font-semibold text-slate-700 dark:text-white">Event Dengan Status Aktif</h6>
                </div>
                <h4 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $totalEventActive }}</h4>
                <div class="mt-2 space-y-1 text-xs">
                    <p><span class="inline-block w-2 h-2 mr-2 rounded-full bg-blue-500"></span>Selesai: {{ $eventSelesai }}</p>
                    <p><span class="inline-block w-2 h-2 mr-2 rounded-full bg-blue-500"></span>Akan Berlangsung: {{ $eventBerlangsung }}</p>
                </div>
            </div>
            <div class="w-32 h-32">
                <canvas id="eventDonutChart"></canvas>
            </div>
        </div>
    </div>
    <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none mt-0">
        <div class="border shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-white">
            <div class="p-4 border-b">
                <h6 class="text-base font-bold text-slate-800 dark:text-white">Struktur Organisasi</h6>
            </div>
            <div class="flex-auto p-4">
                <ul class="space-y-3">
                    <li class="flex items-center space-x-3 pb-2 border-b">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-500">
                            <i class="fas fa-user text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-700 dark:text-white">Muhammad Fadhli Wafi</p>
                            <span class="text-xs font-bold text-red-600">KETUA YAYASAN</span>
                        </div>
                    </li>
                    <li class="flex items-center space-x-3 pb-2 border-b">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-500">
                            <i class="fas fa-user text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-700 dark:text-white">Adhima Tenripoliwati</p>
                            <span class="text-xs font-bold text-red-600">SEKRETARIS</span>
                        </div>
                    </li>
                    <li class="flex items-center space-x-3">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-500">
                            <i class="fas fa-user text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-700 dark:text-white">Erni Novita</p>
                            <span class="text-xs font-bold text-red-600">BENDAHARA</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        
    </div> 
</div>





@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   window.onload = function () {
    const ctx = document.getElementById('eventBarChart').getContext('2d');
    const initialData = @json($monthlyData);
    const colors = [
        'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)',
        'rgba(199, 199, 199, 0.6)', 'rgba(255, 99, 71, 0.6)', 'rgba(54, 235, 162, 0.6)',
        'rgba(255, 205, 86, 0.6)', 'rgba(54, 162, 255, 0.6)', 'rgba(255, 102, 153, 0.6)'
    ];

    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Event Selesai',
                data: initialData,
                backgroundColor: colors,
                borderColor: colors.map(c => c.replace('0.6', '1')),
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { 
                y: { 
                    beginAtZero: true, 
                    ticks: { stepSize: 10 },
                    suggestedMax: 40
                } 
            }
        }
    });

    document.getElementById('yearFilter').addEventListener('change', function() {
        fetch(`{{ route('backoffice.dashboard.chartData') }}?year=${this.value}`)
            .then(res => res.json())
            .then(data => {
                chart.data.datasets[0].data = data.monthlyData;
                chart.update();
            });
    });

    const donutCtx = document.getElementById('eventDonutChart').getContext('2d');
    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Mendatang'],
            datasets: [{
                data: [{{ $eventSelesai }}, {{ $eventBerlangsung }}],
                backgroundColor: ['#3b82f6', '#9ca3af'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '75%',
            plugins: { legend: { display: false } }
        }
    });
};

</script>
@endpush
