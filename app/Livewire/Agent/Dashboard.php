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
        // An agent's active ticket is just whatever is processing and assigned to them, regardless of service_id restriction
        $this->activeTicket = Ticket::where('status', 'processing')
            ->where('user_id', Auth::id())
            ->first();
    }

    public function callNext()
    {
        if ($this->activeTicket) {
            return;
        }

        $serviceId = Auth::user()->service_id;
        
        $query = Ticket::where('status', 'waiting')->orderBy('id', 'asc');
        
        if ($serviceId) {
            $query->where('service_id', $serviceId);
        }
        
        $nextTicket = $query->first();

        if ($nextTicket) {
            $nextTicket->update([
                'status' => 'processing',
                'user_id' => Auth::id()
            ]);
            $this->activeTicket = $nextTicket;
        }
    }

    public function completeService()
    {
        if ($this->activeTicket) {
            $ticket = $this->activeTicket;
            $waitTime = $ticket->updated_at->diffInSeconds($ticket->created_at);
            
            $ticket->update(['status' => 'completed']);
            
            $serviceTime = now()->diffInSeconds($ticket->updated_at);
            
            StatisticsLog::create([
                'ticket_id' => $ticket->id,
                'wait_time' => $waitTime,
                'service_time' => $serviceTime,
            ]);

            $this->activeTicket = null;
        }
    }

    public function render()
    {
        $serviceId = Auth::user()->service_id;
        
        $query = Ticket::where('status', 'waiting');
        
        if ($serviceId) {
            $query->where('service_id', $serviceId);
        }
        
        $queueCount = (clone $query)->count();
        $queues = $query->orderBy('id', 'asc')->get();

        return view('livewire.agent.dashboard', [
            'queueCount' => $queueCount,
            'queues' => $queues,
        ])->layout('layouts.app');
    }
}
