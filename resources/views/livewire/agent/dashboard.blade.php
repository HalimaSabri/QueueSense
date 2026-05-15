<div class="py-12 bg-slate-50 min-h-screen" wire:poll.5s>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Agent Workspace</h1>
                <p class="mt-1 text-slate-500 font-medium">Serving excellence, one client at a time.</p>
            </div>
            
            <div class="flex items-center bg-white p-2 rounded-2xl shadow-sm border border-slate-200/60">
                <div class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl font-bold text-xs uppercase tracking-widest flex items-center">
                    <span class="relative flex h-2 w-2 mr-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    {{ $queueCount }} in queue
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Service Panel (Active) -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-200/60 p-10 flex flex-col items-center justify-center min-h-[450px] relative overflow-hidden transition-all duration-500">
                    @if($activeTicket)
                        <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                        <div class="absolute top-10 right-10">
                            <span class="px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-xs font-black uppercase tracking-widest border border-blue-100">
                                In Progress
                            </span>
                        </div>

                        <div class="text-center">
                            <span class="text-xs uppercase tracking-[0.3em] text-slate-400 font-black mb-4 block">Currently Serving</span>
                            <div class="text-9xl font-black text-slate-900 mb-6 tracking-tighter">{{ $activeTicket->number }}</div>
                            <div class="inline-flex items-center px-6 py-2 bg-slate-100 text-slate-700 rounded-2xl font-bold text-sm mb-12">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                {{ $activeTicket->service->name }}
                            </div>
                            
                            <div class="flex justify-center">
                                <button wire:click="completeService" class="group relative px-12 py-5 bg-slate-900 text-white font-black rounded-2xl shadow-2xl shadow-slate-900/20 hover:bg-slate-800 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center">
                                    <span class="mr-3 uppercase tracking-widest">Complete Service</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="text-center max-w-sm">
                            <div class="w-24 h-24 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-8 border border-slate-100 shadow-inner">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <h2 class="text-2xl font-black text-slate-900 mb-3">Idle & Ready</h2>
                            <p class="text-slate-500 mb-10 leading-relaxed font-medium">Ready to assist the next client? Click the button below to pull the next ticket from the queue.</p>
                            
                            <button wire:click="callNext" @if($queueCount === 0) disabled @endif class="w-full px-10 py-5 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-black rounded-2xl shadow-xl shadow-blue-500/30 transition-all transform hover:-translate-y-1 active:scale-95 disabled:opacity-30 disabled:grayscale disabled:cursor-not-allowed disabled:transform-none uppercase tracking-widest">
                                Call Next Client
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar (Queue List) -->
            <div class="space-y-8">
                <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-200/60 p-8 flex flex-col h-[550px]">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-black text-slate-900 tracking-tight">Queue List</h3>
                        <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-black uppercase tracking-tighter">{{ count($queues) }}</span>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto space-y-4 pr-2 custom-scrollbar">
                        @forelse($queues as $q)
                            <div class="group p-5 rounded-2xl border border-slate-100 bg-slate-50/30 hover:bg-white hover:border-blue-200 hover:shadow-lg hover:shadow-blue-500/5 transition-all duration-300">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-2xl font-black text-slate-900 group-hover:text-blue-600 transition-colors">{{ $q->number }}</span>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $q->created_at->format('H:i') }}</span>
                                </div>
                                <div class="flex items-center text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    <div class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-2"></div>
                                    {{ $q->service->name }}
                                </div>
                            </div>
                        @empty
                            <div class="flex-1 flex flex-col items-center justify-center text-slate-400 space-y-4">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center opacity-50">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <p class="font-bold uppercase text-[10px] tracking-widest">Queue is clear</p>
                            </div>
                        @endforelse
                    </div>
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
