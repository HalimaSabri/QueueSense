<div class="py-12 bg-slate-50 min-h-screen font-sans" wire:poll.5s>
    <div class="max-w-7xl mx-auto px-6 space-y-10">
        
        <!-- Professional Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight font-['Outfit']">Service Workspace</h1>
                <p class="mt-2 text-slate-500 font-medium">Monitoring and managing active client sessions.</p>
            </div>
            
            <div class="flex items-center bg-white px-6 py-3 rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center text-slate-900 font-bold text-[11px] uppercase tracking-widest">
                    <span class="relative flex h-2 w-2 mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                    </span>
                    <span class="text-indigo-600 mr-2">{{ $queueCount }}</span> Clients Waiting
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- Active Console -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 p-12 min-h-[500px] flex flex-col items-center justify-center relative overflow-hidden transition-all duration-500">
                    @if($activeTicket)
                        <div class="absolute top-0 inset-x-0 h-2 bg-indigo-600"></div>
                        <div class="text-center">
                            <span class="text-[11px] uppercase tracking-[0.2em] text-slate-500 font-bold mb-8 block">Currently Serving</span>
                            <div class="text-[10rem] font-black text-slate-900 leading-none font-['Outfit'] tracking-tighter mb-12">
                                {{ $activeTicket->number }}
                            </div>
                            
                            <button wire:click="completeService" class="group px-12 py-5 bg-white border-2 border-slate-900 text-slate-900 text-[11px] font-bold uppercase tracking-[0.2em] rounded-2xl hover:bg-slate-50 transition-all flex items-center mx-auto shadow-xl shadow-slate-200/50">
                                Complete Session
                                <svg class="w-4 h-4 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    @else
                        <div class="text-center max-w-sm">
                            <div class="w-24 h-24 bg-slate-50 rounded-[2rem] flex items-center justify-center mx-auto mb-10 border border-slate-100">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <h2 class="text-3xl font-extrabold text-slate-900 mb-4 font-['Outfit']">Ready for Service</h2>
                            <p class="text-slate-500 mb-12 leading-relaxed">System in standby. Click below to retrieve the next client from the queue.</p>
                            
                            <button wire:click="callNext" @if($queueCount === 0) disabled @endif class="w-full px-10 py-5 bg-white border-2 border-indigo-600 text-slate-900 text-[11px] font-bold uppercase tracking-[0.2em] rounded-2xl hover:bg-indigo-50 transition-all disabled:opacity-20 shadow-xl shadow-indigo-100">
                                Pull Next Client
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Queue Sidebar -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 p-10 h-[600px] flex flex-col">
                <div class="flex items-center justify-between mb-10 border-b border-slate-50 pb-6">
                    <h3 class="text-xl font-bold text-slate-900 font-['Outfit']">Incoming Queue</h3>
                    <span class="bg-indigo-50 text-indigo-600 px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest border border-indigo-100">{{ count($queues) }}</span>
                </div>
                
                <div class="flex-1 overflow-y-auto space-y-5 pr-2 custom-scrollbar">
                    @forelse($queues as $q)
                        <div class="group p-6 rounded-[1.5rem] border border-slate-100 bg-slate-50/50 hover:bg-indigo-50/50 hover:border-indigo-200 transition-all">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-3xl font-black text-slate-900 font-['Outfit'] tracking-tighter">{{ $q->number }}</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase">{{ $q->created_at->format('H:i') }}</span>
                            </div>
                            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                {{ $q->service->name }}
                            </div>
                        </div>
                    @empty
                        <div class="flex-1 flex flex-col items-center justify-center text-slate-300 italic">
                            No Pending Clients
                        </div>
                    @endforelse
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
