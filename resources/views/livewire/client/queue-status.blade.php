<div class="min-h-screen bg-[#0f172a] flex flex-col items-center justify-center p-6 text-white font-sans relative overflow-hidden" wire:poll.5s>
    <!-- Background Accents -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 blur-[150px] rounded-full pointer-events-none"></div>

    <div class="max-w-2xl w-full relative z-10">
        <div class="bg-slate-800/40 backdrop-blur-2xl border border-white/10 p-12 rounded-[2.5rem] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.5)] text-center">
            
            <div class="inline-flex items-center px-4 py-1.5 mb-10 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-widest">
                <span class="relative flex h-2 w-2 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Live Queue Status
            </div>

            <h2 class="text-slate-400 text-lg font-medium mb-4">Your Ticket</h2>
            <div class="text-8xl md:text-9xl font-black text-transparent bg-clip-text bg-gradient-to-b from-white to-slate-500 mb-12 select-none tracking-tighter">
                {{ $ticket->number }}
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <div class="p-8 bg-slate-900/60 rounded-3xl border border-white/5 relative overflow-hidden group hover:border-emerald-500/30 transition-colors">
                    <div class="relative z-10">
                        <span class="block text-4xl font-black text-emerald-400 mb-1">{{ max(0, $position - 1) }}</span>
                        <span class="text-xs text-slate-500 uppercase tracking-widest font-bold">People Ahead</span>
                    </div>
                </div>
                <div class="p-8 bg-slate-900/60 rounded-3xl border border-white/5 relative overflow-hidden group hover:border-blue-500/30 transition-colors">
                    <div class="relative z-10">
                        <span class="block text-4xl font-black text-blue-400 mb-1">~{{ max(0, $estimatedWaitTime) }}</span>
                        <span class="text-xs text-slate-500 uppercase tracking-widest font-bold">Mins to wait</span>
                    </div>
                </div>
            </div>

            <div class="bg-slate-900/40 rounded-3xl p-8 border border-white/5 mb-10">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-slate-400 font-medium">Service</span>
                    <span class="text-white font-bold">{{ $ticket->service->name }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-400 font-medium">Current Status</span>
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest
                        {{ $ticket->status === 'waiting' ? 'bg-amber-400/10 text-amber-400 border border-amber-400/20' : 
                           ($ticket->status === 'processing' ? 'bg-blue-400/10 text-blue-400 border border-blue-400/20 animate-pulse' : 'bg-emerald-400/10 text-emerald-400 border border-emerald-400/20') }}">
                        {{ $ticket->status }}
                    </span>
                </div>
            </div>

            @if($ticket->status === 'processing')
                <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl text-white font-bold shadow-lg shadow-blue-500/30 mb-10 transform scale-105 transition-transform">
                    🔥 It's your turn! Please proceed to the counter.
                </div>
            @endif

            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="{{ route('home') }}" wire:navigate class="text-sm font-bold text-slate-500 hover:text-white transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    New Ticket
                </a>
                <button onclick="window.print()" class="text-sm font-bold text-slate-500 hover:text-white transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Print PDF
                </button>
            </div>
        </div>
    </div>
</div>
