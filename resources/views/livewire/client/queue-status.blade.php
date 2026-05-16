<div class="min-h-screen bg-[#0a0a0a] flex flex-col items-center justify-center p-6 text-slate-300 font-sans" wire:poll.5s>
    <div class="max-w-2xl w-full">
        <div class="bg-[#161616] border border-white/5 p-12 md:p-16 rounded-3xl text-center shadow-2xl relative overflow-hidden">
            <div class="inline-flex items-center px-3 py-1 mb-10 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-bold uppercase tracking-wider">
                <span class="flex h-1.5 w-1.5 rounded-full bg-indigo-500 mr-2"></span>
                Live Status
            </div>

            <div class="mb-12">
                <span class="text-slate-600 text-[10px] font-bold uppercase tracking-widest mb-4 block">Ticket Number</span>
                <div class="text-8xl md:text-9xl font-bold text-white leading-none font-['Outfit'] tracking-tight">
                    {{ $ticket->number }}
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-12">
                <div class="p-6 bg-[#1a1a1a] rounded-2xl border border-white/5">
                    <span class="block text-3xl font-bold text-white mb-1 font-['Outfit']">{{ max(0, $position - 1) }}</span>
                    <span class="text-[10px] text-slate-600 uppercase tracking-wider font-bold">Ahead of you</span>
                </div>
                <div class="p-6 bg-[#1a1a1a] rounded-2xl border border-white/5">
                    <div class="flex items-baseline justify-center gap-1 mb-1">
                        <span class="text-3xl font-bold text-white font-['Outfit']">{{ max(0, $estimatedWaitTime) }}</span>
                        <span class="text-[10px] font-bold text-slate-600 uppercase">min</span>
                    </div>
                    <span class="text-[10px] text-slate-600 uppercase tracking-wider font-bold">Estimated</span>
                </div>
            </div>

            <div class="bg-[#1a1a1a] rounded-2xl p-6 border border-white/5 mb-10">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-slate-600 text-[10px] font-bold uppercase tracking-wider">Service</span>
                    <span class="text-white font-bold text-sm">{{ $ticket->service->name }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-600 text-[10px] font-bold uppercase tracking-wider">Current Status</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                        {{ $ticket->status === 'waiting' ? 'bg-amber-500/10 text-amber-500' : 
                           ($ticket->status === 'processing' ? 'bg-indigo-500/10 text-indigo-400' : 'bg-emerald-500/10 text-emerald-500') }}">
                        {{ $ticket->status }}
                    </span>
                </div>
            </div>

            @if($ticket->status === 'processing')
                <div class="p-6 bg-indigo-600 rounded-2xl text-white font-bold mb-10 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Proceed to Counter
                </div>
            @endif

            <div class="flex flex-col sm:flex-row items-center justify-center gap-8 pt-4">
                <a href="{{ route('home') }}" wire:navigate class="text-[10px] font-bold text-slate-600 hover:text-white uppercase tracking-widest transition-colors flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    New Request
                </a>
                <button onclick="window.print()" class="text-[10px] font-bold text-slate-600 hover:text-white uppercase tracking-widest transition-colors flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Export PDF
                </button>
            </div>
        </div>
    </div>
</div>
>
