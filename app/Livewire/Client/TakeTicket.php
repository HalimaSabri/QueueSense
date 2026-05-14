<?php

namespace App\Livewire\Client;

use App\Models\Service;
use App\Models\Ticket;
use Livewire\Component;

class TakeTicket extends Component
{
    public $services;

    public function mount()
    {
        $this->services = Service::all();
    }

    public function takeTicket($serviceId)
    {
        $service = Service::findOrFail($serviceId);

        $prefix = strtoupper(substr($service->name, 0, 1));
        $todayTicketsCount = Ticket::where('service_id', $service->id)->whereDate('created_at', today())->count();
        $number = $prefix . '-' . str_pad($todayTicketsCount + 1, 3, '0', STR_PAD_LEFT);

        $ticket = Ticket::create([
            'number' => $number,
            'service_id' => $service->id,
            'status' => 'waiting',
        ]);

        return redirect()->route('queue.status', ['ticket' => $ticket->id]);
    }

    public function render()
    {
        return view('livewire.client.take-ticket')->layout('layouts.client');
    }
}
