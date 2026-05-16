<div class="py-12 bg-white min-h-screen font-sans" wire:poll.5s>
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Minimal Status Header -->
        <div class="flex items-center justify-between mb-12 border-b border-slate-100 pb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight font-['Outfit']">Service Terminal</h1>
                <div class="flex items-center mt-1 text-[11px] font-bold uppercase tracking-[0.1em] text-slate-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 shadow-[0_0_8px_rgba(16,185,129,0.4)]"></span>
                    Operational Node • {{ auth()->user()->service ? auth()->user()->service->name : 'Global' }}
                </div>
            </div>
            
            <div class="text-right">
                <span class="block text-2xl font-bold text-slate-900 leading-none">{{ $queueCount }}</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 block">In Queue</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Main Active Console -->
            <div class="lg:col-span-8">
                <div class="bg-slate-50 rounded-2xl border border-slate-100 p-12 min-h-[400px] flex flex-col items-center justify-center relative">
                    @if($activeTicket)
                        <div class="text-center">
                            <span class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-bold mb-8 block italic">Active Client</span>
                            <div class="text-[12rem] font-black text-slate-900 leading-none font-['Outfit'] tracking-tighter mb-12">
                                {{ $activeTicket->number }}
                            </div>
                            
                            <button wire:click="completeService" class="group px-10 py-4 bg-white border border-slate-900 text-slate-900 text-[11px] font-bold uppercase tracking-[0.2em] rounded-lg hover:bg-slate-50 transition-all flex items-center mx-auto">
                                Complete Session
                                <svg class="w-4 h-4 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    @else
                        <div class="text-center max-w-sm">
                            <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mx-auto mb-8 border border-slate-200 shadow-sm">
                                <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <h2 class="text-lg font-bold text-slate-900 mb-2">Node Idle</h2>
                            <p class="text-slate-500 text-sm mb-10">Standby for next client request.</p>
                            
                            <button wire:click="callNext" @if($queueCount === 0) disabled @endif class="w-full px-8 py-4 bg-white border border-indigo-600 text-slate-900 text-[11px] font-bold uppercase tracking-[0.2em] rounded-lg hover:bg-indigo-50 transition-all disabled:opacity-10 disabled:cursor-not-allowed">
                                Pull Next Ticket
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Minimal Sidebar -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-2xl border border-slate-100 p-8 h-[500px] flex flex-col">
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-[0.2em] mb-8 border-b border-slate-50 pb-4">Upcoming</h3>
                    
                    <div class="flex-1 overflow-y-auto space-y-4 pr-2 custom-scrollbar">
                        @forelse($queues as $q)
                            <div class="flex items-center justify-between p-4 rounded-xl border border-slate-50 bg-slate-50/20 hover:bg-slate-50 hover:border-slate-100 transition-all">
                                <div>
                                    <span class="text-xl font-bold text-slate-900 font-['Outfit']">{{ $q->number }}</span>
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ $q->service->name }}</span>
                                </div>
                                <span class="text-[10px] font-bold text-slate-300 uppercase tabular-nums">{{ $q->created_at->format('H:i') }}</span>
                            </div>
                        @empty
                            <div class="flex-1 flex flex-col items-center justify-center text-slate-300 opacity-50 italic text-sm">
                                Empty
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #e2e8f0; }
    </style>
</div>
