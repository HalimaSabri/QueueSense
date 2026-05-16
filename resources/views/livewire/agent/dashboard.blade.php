<div class="py-12 bg-slate-50 min-h-screen font-sans" wire:poll.5s>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-10">
        
        <!-- Professional Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight font-['Outfit']">Service Dashboard</h1>
                <p class="mt-2 text-slate-600 font-medium leading-relaxed">Managing client throughput and service excellence.</p>
            </div>
            
            <div class="flex items-center bg-white px-5 py-3 rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center text-slate-600 font-bold text-[11px] uppercase tracking-widest">
                    <span class="relative flex h-2 w-2 mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                    </span>
                    <span class="text-indigo-600 mr-2">{{ $queueCount }}</span> <span class="text-slate-600">Pending Requests</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- Active Service Panel -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 p-12 flex flex-col items-center justify-center min-h-[500px] relative overflow-hidden transition-all duration-500">
                    @if($activeTicket)
                        <div class="absolute top-0 inset-x-0 h-1.5 bg-indigo-600"></div>
                        <div class="absolute top-10 right-12">
                            <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-full text-[10px] font-bold uppercase tracking-widest border border-indigo-100">
                                Session Active
                            </span>
                        </div>

                        <div class="text-center">
                            <span class="text-[11px] uppercase tracking-[0.2em] text-slate-600 font-bold mb-6 block">Current Client Identity</span>
                            <div class="text-[10rem] font-black text-slate-900 mb-8 leading-none font-['Outfit'] tracking-tighter">{{ $activeTicket->number }}</div>
                            <div class="inline-flex items-center px-6 py-2.5 bg-slate-50 text-slate-600 border border-slate-100 rounded-2xl font-bold text-sm mb-12">
                                <svg class="w-4 h-4 mr-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                {{ $activeTicket->service->name }}
                            </div>
                            
                            <div class="flex justify-center">
                                <button wire:click="completeService" class="group relative px-12 py-5 bg-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-500/20 hover:bg-indigo-700 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center uppercase tracking-widest text-[11px]">
                                    <span>Complete Session</span>
                                    <svg class="w-4 h-4 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="text-center max-w-sm">
                            <div class="w-24 h-24 bg-slate-50 rounded-[2rem] flex items-center justify-center mx-auto mb-10 border border-slate-100 shadow-inner">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <h2 class="text-3xl font-extrabold text-slate-900 mb-4 font-['Outfit']">Ready for Service</h2>
                            <p class="text-slate-600 mb-12 leading-relaxed">The system is standing by. Click below to retrieve the next available client from the queue.</p>
                            
                            <button wire:click="callNext" @if($queueCount === 0) disabled @endif class="w-full px-10 py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl shadow-indigo-500/20 transition-all transform hover:-translate-y-1 active:scale-95 disabled:opacity-20 disabled:grayscale disabled:cursor-not-allowed disabled:transform-none uppercase tracking-widest text-[11px]">
                                Call Next Client
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Queue Management Sidebar -->
            <div class="space-y-8">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 p-10 flex flex-col h-[600px]">
                    <div class="flex items-center justify-between mb-10">
                        <h3 class="text-xl font-bold text-slate-900 tracking-tight font-['Outfit']">Live Queue</h3>
                        <span class="bg-indigo-50 text-indigo-600 px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest border border-indigo-100">{{ count($queues) }}</span>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto space-y-5 pr-2 custom-scrollbar">
                        @forelse($queues as $q)
                            <div class="group p-6 rounded-[1.5rem] border border-slate-100 bg-slate-50/50 hover:bg-indigo-50/50 hover:border-indigo-200 transition-all duration-300">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-3xl font-black text-slate-900 group-hover:text-indigo-600 transition-colors font-['Outfit'] tracking-tighter">{{ $q->number }}</span>
                                    <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">{{ $q->created_at->format('H:i') }}</span>
                                </div>
                                <div class="flex items-center text-[10px] font-bold text-slate-600 uppercase tracking-widest">
                                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2.5"></div>
                                    {{ $q->service->name }}
                                </div>
                            </div>
                        @empty
                            <div class="flex-1 flex flex-col items-center justify-center text-slate-600 space-y-6">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center opacity-50 border border-slate-100">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <p class="font-bold uppercase text-[10px] tracking-[0.2em]">Queue Clear</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
    </style>
</div>
