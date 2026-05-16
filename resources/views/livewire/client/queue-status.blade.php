<div class="min-h-screen bg-slate-50 flex flex-col items-center justify-center p-6 text-slate-900 font-sans" wire:poll.5s>
    <div class="max-w-xl w-full">
        <div class="bg-white border border-slate-200 p-12 md:p-16 rounded-[2.5rem] text-center shadow-xl relative overflow-hidden">
            <div class="inline-flex items-center px-3 py-1 mb-10 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-600 text-[10px] font-bold uppercase tracking-widest">
                <span class="flex h-1.5 w-1.5 rounded-full bg-indigo-600 mr-2 animate-pulse"></span>
                Live Status
            </div>

            <div class="mb-12">
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-4 block">Ticket Identity</span>
                <div class="text-9xl font-black text-slate-900 leading-none font-['Outfit'] tracking-tight">
                    {{ $ticket->number }}
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-6 mb-12">
                <div class="p-8 bg-slate-50 rounded-3xl border border-slate-100">
                    <span class="block text-4xl font-bold text-slate-900 mb-1 font-['Outfit']">{{ max(0, $position - 1) }}</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Ahead of you</span>
                </div>
                <div class="p-8 bg-slate-50 rounded-3xl border border-slate-100">
                    <div class="flex items-baseline justify-center gap-1 mb-1">
                        <span class="text-4xl font-bold text-slate-900 font-['Outfit']">{{ max(0, $estimatedWaitTime) }}</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase">min</span>
                    </div>
                    <span class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Est. Wait</span>
                </div>
            </div>

            <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 mb-10">
                <div class="flex items-center justify-between mb-4 pb-4 border-b border-slate-200/50">
                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Service</span>
                    <span class="text-slate-900 font-bold text-sm">{{ $ticket->service->name }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Protocol Status</span>
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                        {{ $ticket->status === 'waiting' ? 'bg-amber-50 text-amber-600 border border-amber-100' : 
                           ($ticket->status === 'processing' ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : 'bg-emerald-50 text-emerald-600 border border-emerald-100') }}">
                        {{ $ticket->status }}
                    </span>
                </div>
            </div>

            @if($ticket->status === 'processing')
                <div class="p-6 bg-indigo-600 rounded-2xl text-white font-bold mb-10 flex items-center justify-center gap-3 shadow-lg shadow-indigo-500/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Please Proceed to Counter
                </div>
            @endif

            <div class="flex flex-col sm:flex-row items-center justify-center gap-8 pt-4">
                <a href="{{ route('home') }}" wire:navigate class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    New Request
                </a>
                <button onclick="window.print()" class="text-[10px] font-bold text-slate-400 hover:text-slate-900 uppercase tracking-widest transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Print Ticket
                </button>
            </div>
        </div>
    </div>
</div>
>
