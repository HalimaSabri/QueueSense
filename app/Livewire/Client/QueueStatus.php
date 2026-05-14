<?php

namespace App\Livewire\Client;

use App\Models\Ticket;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

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

        // Attempt to get prediction from Python AI microservice
        try {
            $response = Http::timeout(2)->get('http://127.0.0.1:8000/predict', [
                'service_id' => $this->ticket->service_id,
                'queue_length' => $this->position
            ]);
            
            if ($response->successful()) {
                $this->estimatedWaitTime = $response->json('estimated_wait_time');
            } else {
                $this->fallbackEstimation();
            }
        } catch (\Exception $e) {
            // Fallback if the microservice is down
            $this->fallbackEstimation();
        }
    }

    private function fallbackEstimation()
    {
        $averageTime = $this->ticket->service->average_time ?? 10;
        $this->estimatedWaitTime = $this->position * $averageTime;
    }

    public function render()
    {
        $this->calculateStatus();
        return view('livewire.client.queue-status')->layout('layouts.client');
    }
}
