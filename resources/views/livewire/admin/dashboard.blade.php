<div class="py-12 bg-[#f8fafc] min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Analytics Overview</h1>
                <p class="mt-2 text-slate-500 font-medium">Real-time insights and performance metrics for QueueSense.</p>
            </div>
            
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-slate-200/60">
                <button class="px-4 py-2 bg-slate-900 text-white text-xs font-black rounded-xl uppercase tracking-widest hover:bg-slate-800 transition-colors">Export Report</button>
                <div class="w-px h-6 bg-slate-200 mx-1"></div>
                <span class="px-4 text-slate-400 text-xs font-bold">{{ now()->format('M d, Y') }}</span>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-[2rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-200/60 relative overflow-hidden group hover:scale-[1.02] transition-transform duration-500">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-8 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-slate-400 text-xs font-black uppercase tracking-widest mb-1">Served Today</h3>
                <p class="text-5xl font-black text-slate-900 tracking-tight">{{ $todayServed }}</p>
                <div class="mt-6 flex items-center text-emerald-500 text-xs font-bold">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    12% from yesterday
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-200/60 relative overflow-hidden group hover:scale-[1.02] transition-transform duration-500">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-8 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-slate-400 text-xs font-black uppercase tracking-widest mb-1">Avg Wait Time</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-5xl font-black text-slate-900 tracking-tight">{{ $avgWaitTime }}</p>
                    <span class="text-slate-400 font-bold text-lg">mins</span>
                </div>
                <div class="mt-6 flex items-center text-rose-500 text-xs font-bold">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 112 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    4% slow down
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-200/60 relative overflow-hidden group hover:scale-[1.02] transition-transform duration-500">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-8 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-slate-400 text-xs font-black uppercase tracking-widest mb-1">Avg Service</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-5xl font-black text-slate-900 tracking-tight">{{ $avgServiceTime }}</p>
                    <span class="text-slate-400 font-bold text-lg">mins</span>
                </div>
                <div class="mt-6 flex items-center text-emerald-500 text-xs font-bold">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    21% faster
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-200/60 h-[450px] flex flex-col">
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Growth Trend</h3>
                    <select class="bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-500 focus:ring-0 cursor-pointer">
                        <option>Last 7 Days</option>
                        <option>Last 30 Days</option>
                    </select>
                </div>
                <div class="flex-1 min-h-0">
                    <canvas id="servedChart"></canvas>
                </div>
            </div>
            
            <div class="bg-white rounded-[2.5rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-200/60 h-[450px] flex flex-col">
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Efficiency Metric</h3>
                    <div class="flex gap-2">
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Wait Time</span>
                    </div>
                </div>
                <div class="flex-1 min-h-0">
                    <canvas id="waitChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        const labels = {!! json_encode($labels) !!};
        
        // Custom Chart Defaults
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#94a3b8';
        
        new Chart(document.getElementById('servedChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Clients Served',
                    data: {!! json_encode($servedPerDayData) !!},
                    backgroundColor: '#0f172a',
                    borderRadius: 12,
                    barThickness: 30,
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { display: false }, border: { display: false } },
                    x: { grid: { display: false }, border: { display: false } }
                }
            }
        });

        new Chart(document.getElementById('waitChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Avg Wait (mins)',
                    data: {!! json_encode($avgWaitTimeData) !!},
                    borderColor: '#f59e0b',
                    borderWidth: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#f59e0b',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true,
                    backgroundColor: (context) => {
                        const ctx = context.chart.ctx;
                        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                        gradient.addColorStop(0, 'rgba(245, 158, 11, 0.2)');
                        gradient.addColorStop(1, 'rgba(245, 158, 11, 0)');
                        return gradient;
                    },
                    tension: 0.4
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { borderDash: [5, 5], color: '#f1f5f9' }, border: { display: false } },
                    x: { grid: { display: false }, border: { display: false } }
                }
            }
        });
    });
</script>
