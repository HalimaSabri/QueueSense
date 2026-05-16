<div class="min-h-screen bg-[#030712] flex flex-col items-center justify-center p-8 text-slate-200 font-sans relative overflow-hidden" wire:poll.5s>
    <!-- Background Accents -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-indigo-500/5 blur-[160px] rounded-full pointer-events-none"></div>

    <div class="max-w-3xl w-full relative z-10">
        <div class="bg-white/[0.02] backdrop-blur-3xl border border-white/5 p-12 md:p-16 rounded-[3rem] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.6)] text-center relative overflow-hidden">
            <!-- Decorative Inner Border -->
            <div class="absolute inset-2 border border-white/[0.02] rounded-[2.5rem] pointer-events-none"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center px-4 py-1.5 mb-12 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-bold uppercase tracking-[0.2em]">
                    <span class="relative flex h-2 w-2 mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    Synchronized Live
                </div>

                <div class="mb-16">
                    <span class="text-slate-500 text-xs font-bold uppercase tracking-[0.3em] mb-6 block">Assigned Ticket</span>
                    <div class="text-9xl md:text-[12rem] font-black text-white leading-none font-['Outfit'] tracking-tighter select-none drop-shadow-[0_10px_20px_rgba(255,255,255,0.05)]">
                        {{ $ticket->number }}
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                    <div class="p-10 bg-white/[0.03] rounded-[2rem] border border-white/5 group hover:border-indigo-500/30 transition-all duration-500">
                        <div class="relative z-10">
                            <span class="block text-5xl font-black text-white mb-2 font-['Outfit'] tracking-tight">{{ max(0, $position - 1) }}</span>
                            <span class="text-[10px] text-slate-500 uppercase tracking-[0.2em] font-bold">Clients Ahead</span>
                        </div>
                    </div>
                    <div class="p-10 bg-white/[0.03] rounded-[2rem] border border-white/5 group hover:border-indigo-500/30 transition-all duration-500">
                        <div class="relative z-10">
                            <div class="flex items-baseline justify-center gap-1 mb-2">
                                <span class="text-5xl font-black text-white font-['Outfit'] tracking-tight">{{ max(0, $estimatedWaitTime) }}</span>
                                <span class="text-sm font-bold text-slate-500 font-['Outfit']">MIN</span>
                            </div>
                            <span class="text-[10px] text-slate-500 uppercase tracking-[0.2em] font-bold">Estimated Wait</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white/[0.01] rounded-3xl p-10 border border-white/5 mb-12 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-left">
                        <span class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.2em] block mb-1">Service Type</span>
                        <span class="text-white font-bold text-lg font-['Outfit']">{{ $ticket->service->name }}</span>
                    </div>
                    <div class="h-px w-full md:w-px md:h-12 bg-white/5"></div>
                    <div class="text-right">
                        <span class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.2em] block mb-2">Queue Protocol</span>
                        <span class="inline-flex items-center px-5 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-[0.2em]
                            {{ $ticket->status === 'waiting' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : 
                               ($ticket->status === 'processing' ? 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 animate-pulse' : 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20') }}">
                            {{ $ticket->status }}
                        </span>
                    </div>
                </div>

                @if($ticket->status === 'processing')
                    <div class="p-8 bg-indigo-600 rounded-[1.5rem] text-white font-bold shadow-[0_20px_40px_rgba(79,70,229,0.3)] mb-12 transform scale-105 transition-all animate-bounce">
                        <div class="flex items-center justify-center gap-3 text-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Your Turn • Please proceed to counter
                        </div>
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
                    <a href="{{ route('home') }}" wire:navigate class="text-[11px] font-bold text-slate-500 hover:text-white uppercase tracking-[0.2em] transition-all flex items-center group">
                        <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Request New
                    </a>
                    <button onclick="window.print()" class="text-[11px] font-bold text-slate-500 hover:text-white uppercase tracking-[0.2em] transition-all flex items-center group">
                        <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Export PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
