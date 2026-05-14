<div class="min-h-screen bg-slate-900 flex flex-col items-center justify-center p-6 text-white font-sans" wire:poll.5s>
    <div class="max-w-xl w-full bg-slate-800/50 backdrop-blur-xl border border-white/10 p-10 rounded-3xl shadow-2xl text-center relative overflow-hidden">
        
        <!-- Glowing effect behind ticket -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-64 h-64 bg-emerald-500/20 blur-[100px] rounded-full pointer-events-none"></div>

        <h2 class="text-slate-400 text-lg mb-2 relative z-10">Your Ticket Number</h2>
        <div class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400 mb-8 relative z-10">
            {{ $ticket->number }}
        </div>
        
        <div class="bg-slate-900/50 rounded-2xl p-6 border border-white/5 mb-8 relative z-10">
            <h3 class="text-xl font-medium text-white mb-1">{{ $ticket->service->name }}</h3>
            <p class="text-sm text-slate-400 mb-6">Status: 
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                    {{ $ticket->status === 'waiting' ? 'bg-yellow-400/10 text-yellow-400' : 
                       ($ticket->status === 'processing' ? 'bg-blue-400/10 text-blue-400' : 'bg-emerald-400/10 text-emerald-400') }}">
                    {{ ucfirst($ticket->status) }}
                </span>
            </p>

            @if($ticket->status === 'waiting')
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col items-center p-4 bg-white/5 rounded-xl">
                        <span class="text-3xl font-bold text-white">{{ max(0, $position - 1) }}</span>
                        <span class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Ahead of You</span>
                    </div>
                    <div class="flex flex-col items-center p-4 bg-white/5 rounded-xl">
                        <span class="text-3xl font-bold text-white">~{{ max(0, $estimatedWaitTime) }}</span>
                        <span class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Mins Wait</span>
                    </div>
                </div>
            @elseif($ticket->status === 'processing')
                <div class="p-4 bg-blue-500/20 border border-blue-500/30 rounded-xl text-blue-200 animate-pulse">
                    It's your turn! Please proceed to the counter.
                </div>
            @else
                <div class="p-4 bg-emerald-500/20 border border-emerald-500/30 rounded-xl text-emerald-200">
                    This ticket is completed. Have a nice day!
                </div>
            @endif
        </div>

        <div class="relative z-10">
            <a href="{{ route('home') }}" wire:navigate class="text-sm text-emerald-400 hover:text-emerald-300 transition-colors">Take another ticket</a>
        </div>
    </div>
</div>
