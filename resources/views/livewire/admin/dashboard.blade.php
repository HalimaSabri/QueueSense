<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Clients Served Today</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $todayServed }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Avg Wait Time</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $avgWaitTime }} <span class="text-lg text-gray-400">mins</span></p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center">
                <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Avg Service Time</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $avgServiceTime }} <span class="text-lg text-gray-400">mins</span></p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 h-80 relative">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Clients Served (Last 7 Days)</h3>
                <div class="absolute inset-0 top-16 p-6 pb-2 pl-2">
                    <canvas id="servedChart"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 h-80 relative">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Avg Wait Time in Mins (Last 7 Days)</h3>
                <div class="absolute inset-0 top-16 p-6 pb-2 pl-2">
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
        
        new Chart(document.getElementById('servedChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Clients Served',
                    data: {!! json_encode($servedPerDayData) !!},
                    backgroundColor: '#3b82f6',
                    borderRadius: 6
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        new Chart(document.getElementById('waitChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Avg Wait Time (mins)',
                    data: {!! json_encode($avgWaitTimeData) !!},
                    borderColor: '#eab308',
                    backgroundColor: 'rgba(234, 179, 8, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    });
</script>
