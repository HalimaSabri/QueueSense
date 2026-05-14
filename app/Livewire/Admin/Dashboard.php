<?php

namespace App\Livewire\Admin;

use App\Models\StatisticsLog;
use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render()
    {
        $todayServed = StatisticsLog::whereDate('created_at', today())->count();
        $avgWaitTime = StatisticsLog::whereDate('created_at', today())->avg('wait_time') ?? 0;
        $avgServiceTime = StatisticsLog::whereDate('created_at', today())->avg('service_time') ?? 0;

        $last7Days = collect(range(6, 0))->map(function($days) {
            return today()->subDays($days)->format('Y-m-d');
        });

        $servedPerDayData = $last7Days->map(function($date) {
            return StatisticsLog::whereHas('ticket')->whereDate('created_at', $date)->count();
        });

        $avgWaitTimeData = $last7Days->map(function($date) {
            return round((StatisticsLog::whereDate('created_at', $date)->avg('wait_time') ?? 0) / 60, 1);
        });

        return view('livewire.admin.dashboard', [
            'todayServed' => $todayServed,
            'avgWaitTime' => round($avgWaitTime / 60, 1),
            'avgServiceTime' => round($avgServiceTime / 60, 1),
            'labels' => $last7Days->map(fn($d) => Carbon::parse($d)->format('M d')),
            'servedPerDayData' => $servedPerDayData,
            'avgWaitTimeData' => $avgWaitTimeData,
        ])->layout('layouts.app');
    }
}
