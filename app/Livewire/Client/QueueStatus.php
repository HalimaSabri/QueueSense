<?php

namespace App\Livewire\Client;

use App\Models\Ticket;
use Livewire\Component;

class QueueStatus extends Component
{
    public Ticket $ticket;
    public $position;
    public $estimatedWaitTime;

    protected $listeners = ['echo:queue,TicketUpdated' => '$refresh'];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->calculateStatus();
    }

    public function calculateStatus()
    {
        // Calculate position in queue for the specific service
        $this->position = Ticket::where('service_id', $this->ticket->service_id)
                                ->where('status', 'waiting')
                                ->where('id', '<', $this->ticket->id)
                                ->count() + 1;

        if ($this->ticket->status !== 'waiting') {
            $this->position = 0;
            $this->estimatedWaitTime = 0;
            return;
        }

        // Simple estimation: average time * position
        $averageTime = $this->ticket->service->average_time ?? 10;
        $this->estimatedWaitTime = $this->position * $averageTime;
    }

    public function render()
    {
        $this->calculateStatus();
        return view('livewire.client.queue-status')->layout('layouts.client');
    }
}
