<?php

namespace App\Livewire\Agent;

use App\Models\Ticket;
use App\Models\StatisticsLog;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $activeTicket = null;

    protected $listeners = ['echo:queue,TicketUpdated' => '$refresh'];

    public function mount()
    {
        $this->loadActiveTicket();
    }

    public function loadActiveTicket()
    {
        $services = Auth::user()->services()->pluck('services.id');
        $this->activeTicket = Ticket::whereIn('service_id', $services)
            ->where('status', 'processing')
            ->first();
    }

    public function callNext()
    {
        if ($this->activeTicket) {
            return;
        }

        $services = Auth::user()->services()->pluck('services.id');
        
        $nextTicket = Ticket::whereIn('service_id', $services)
            ->where('status', 'waiting')
            ->orderBy('id', 'asc')
            ->first();

        if ($nextTicket) {
            $nextTicket->update(['status' => 'processing']);
            $this->activeTicket = $nextTicket;
            // Optionally dispatch event here
        }
    }

    public function completeService()
    {
        if ($this->activeTicket) {
            $waitTime = $this->activeTicket->updated_at->diffInSeconds($this->activeTicket->created_at);
            
            $this->activeTicket->update(['status' => 'completed']);
            
            $serviceTime = now()->diffInSeconds($this->activeTicket->updated_at);
            
            StatisticsLog::create([
                'ticket_id' => $this->activeTicket->id,
                'wait_time' => $waitTime,
                'service_time' => $serviceTime,
            ]);

            $this->activeTicket = null;
        }
    }

    public function render()
    {
        $services = Auth::user()->services()->pluck('services.id');
        $queueCount = Ticket::whereIn('service_id', $services)->where('status', 'waiting')->count();
        $queues = Ticket::whereIn('service_id', $services)->where('status', 'waiting')->orderBy('id', 'asc')->get();

        return view('livewire.agent.dashboard', [
            'queueCount' => $queueCount,
            'queues' => $queues,
        ])->layout('layouts.app');
    }
}
