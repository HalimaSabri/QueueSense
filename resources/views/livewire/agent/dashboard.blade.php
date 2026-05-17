<div class="py-12 bg-[#f4f6f8] min-h-screen font-sans" wire:poll.5s>
    <div class="max-w-[85rem] mx-auto px-6 lg:px-8 space-y-10">
        
        <!-- Top Navigation / Header area -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-[2.25rem] font-bold text-slate-900 leading-tight tracking-tight">Service<br/>Dashboard</h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="bg-white px-5 py-3 rounded-2xl shadow-sm flex items-center border border-gray-200/60">
                    <div class="relative flex h-3 w-3 mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </div>
                    <span class="text-sm font-bold text-slate-800">{{ $queueCount }} Clients Waiting</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Main Content Area -->
            <div class="lg:col-span-8 flex flex-col">
                
                @if($activeTicket)
                <!-- Active Session Card -->
                <div class="bg-[#e2e8f0] rounded-[2.5rem] p-12 flex flex-col items-center justify-center relative overflow-hidden shadow-sm border border-slate-300/50 min-h-[500px] w-full">
                    <div class="text-center z-10 w-full max-w-md">
                        <span class="text-xs uppercase tracking-[0.25em] text-slate-500 font-bold mb-6 block">Currently Serving</span>
                        <div class="text-8xl md:text-[10rem] font-black text-slate-900 leading-none tracking-tighter mb-12">
                            {{ $activeTicket->number }}
                        </div>
                        
                        <button wire:click="completeService" class="group w-full py-5 px-8 bg-transparent border-2 border-slate-900 text-slate-900 text-sm font-bold rounded-2xl hover:bg-slate-50 transition-all flex items-center justify-center mx-auto hover:shadow-lg uppercase tracking-widest">
                            Complete Session
                            <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
                @else
                <!-- Standby Card -->
                <div class="bg-white rounded-[2.5rem] p-12 flex flex-col items-center justify-center relative overflow-hidden shadow-sm border border-gray-200/60 min-h-[500px] w-full">
                    <div class="text-center max-w-md z-10 w-full">
                        <div class="w-24 h-24 bg-[#f4f6f8] rounded-full flex items-center justify-center mx-auto mb-8 border border-gray-200">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <h2 class="text-3xl font-bold text-slate-900 mb-4 tracking-tight">Ready for Service</h2>
                        <p class="text-slate-500 mb-10 text-base leading-relaxed">System in standby. Click below to retrieve the next client from the queue.</p>
                        
                        <!-- Well Defined Button -->
                        <button wire:click="callNext" @if($queueCount === 0) disabled @endif class="w-full py-5 px-8 bg-transparent border-2 border-slate-900 text-slate-900 text-sm font-bold rounded-2xl hover:bg-slate-50 hover:shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-widest">
                            Pull Next Client
                        </button>
                    </div>
                </div>
                @endif
                
            </div>

            <!-- Sidebar List Area -->
            <div class="lg:col-span-4 flex flex-col">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-200/60 p-8 flex flex-col h-[500px]">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Incoming Queue</h3>
                        <span class="text-xs font-bold bg-[#f4f6f8] text-slate-800 px-3 py-1.5 rounded-lg">{{ count($queues) }}</span>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto space-y-2 pr-3 custom-scrollbar">
                        @forelse($queues as $q)
                            <!-- List Item -->
                            <div class="flex items-center justify-between p-4 rounded-2xl hover:bg-[#f4f6f8] transition-colors group">
                                <div class="flex items-center space-x-4">
                                    <!-- Avatar/Icon Circle -->
                                    <div class="w-12 h-12 rounded-full bg-[#e2e8f0] text-slate-900 flex items-center justify-center font-bold text-lg shadow-sm">
                                        {{ substr($q->number, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 text-lg leading-tight">{{ $q->number }}</p>
                                        <p class="text-xs text-slate-500 font-medium mt-0.5">{{ $q->service->name }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-slate-900">{{ $q->created_at->format('H:i') }}</p>
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider mt-1">Arrival</p>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center h-full text-slate-400 space-y-4">
                                <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <p class="text-sm font-semibold">No Clients Waiting</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <!-- Optional View All Button -->
                    @if(count($queues) > 0)
                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <button class="w-full py-3.5 bg-transparent border-2 border-slate-900 text-slate-900 text-sm font-bold rounded-xl hover:bg-slate-50 hover:shadow-lg transition-all uppercase tracking-widest">
                            View All History
                        </button>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
    </style>
</div>
