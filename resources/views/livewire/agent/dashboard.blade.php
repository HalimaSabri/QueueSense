<div class="py-12" wire:poll.5s>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Agent Workspace</h1>
                    <p class="mt-2 text-gray-500">Manage your queue and call the next waiting clients.</p>
                </div>
                
                <div class="text-center md:text-right">
                    <div class="inline-flex items-center justify-center px-4 py-2 bg-blue-50 text-blue-700 rounded-full font-medium text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        {{ $queueCount }} clients waiting
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-6 lg:p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Current Service Panel -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-center min-h-[300px] relative overflow-hidden">
                    @if($activeTicket)
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-400 to-emerald-400"></div>
                        <h2 class="text-sm uppercase tracking-widest text-gray-400 font-semibold mb-2">Currently Serving</h2>
                        <div class="text-7xl font-black text-gray-900 mb-6">{{ $activeTicket->number }}</div>
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium mb-8">
                            {{ $activeTicket->service->name }}
                        </span>
                        
                        <button wire:click="completeService" class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold rounded-xl shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                            Complete Service
                        </button>
                    @else
                        <div class="text-center">
                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 mb-2">Ready for next client</h2>
                            <p class="text-gray-500 mb-8 max-w-xs mx-auto">Click below to call the next person in line from your assigned services.</p>
                            
                            <button wire:click="callNext" @if($queueCount === 0) disabled @endif class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none">
                                Call Next Client
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Queue List -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        Up Next
                        <span class="ml-2 px-2 py-0.5 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full">{{ count($queues) }}</span>
                    </h3>
                    
                    <div class="flex-1 overflow-y-auto pr-2 space-y-3 max-h-[300px]">
                        @forelse($queues as $q)
                            <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-blue-100 hover:bg-blue-50/50 transition-colors">
                                <div>
                                    <span class="block font-bold text-gray-900 text-lg">{{ $q->number }}</span>
                                    <span class="block text-sm text-gray-500">{{ $q->service->name }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-medium text-gray-400 block mb-1">Waiting</span>
                                    <span class="text-sm text-gray-700">{{ $q->created_at->diffForHumans(null, true, true) }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="h-full flex flex-col items-center justify-center text-gray-400 py-12">
                                <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p>The queue is empty.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
