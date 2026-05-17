<div class="min-h-screen bg-[#f4f6f8] flex flex-col items-center justify-center p-6 text-slate-900 font-sans" wire:poll.keep-alive>
    <!-- Professional Top Navigation -->
    <div class="absolute top-8 right-8 z-20">
        <a href="{{ route('login') }}" class="group px-6 py-3 bg-[#1c1c1e] text-white rounded-2xl hover:bg-black hover:shadow-lg transition-all text-xs font-bold uppercase tracking-widest flex items-center shadow-lg shadow-black/10">
            Staff Portal
        </a>
    </div>

    <div class="max-w-[70rem] w-full">
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-[4rem] font-extrabold mb-6 tracking-tight text-slate-900 font-['Outfit'] leading-tight">
                QueueSense
            </h1>
            <p class="text-slate-500 text-lg max-w-xl mx-auto leading-relaxed">
                Experience seamless service. Select a category below to receive your digital ticket.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($services as $service)
                <button wire:click="takeTicket({{ $service->id }})" 
                    class="group relative flex flex-col h-full bg-white border border-gray-200/60 rounded-[2.5rem] p-10 text-left transition-all duration-300 hover:shadow-xl hover:shadow-black/5 hover:-translate-y-1">
                    
                    <div class="w-16 h-16 rounded-[1.5rem] bg-[#f4f6f8] flex items-center justify-center mb-8 group-hover:bg-[#e2e8f0] transition-colors duration-300 shadow-sm border border-transparent group-hover:border-slate-300/50">
                        <svg class="w-8 h-8 text-slate-400 group-hover:text-slate-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>

                    <h3 class="text-2xl font-bold text-slate-900 mb-4 font-['Outfit']">{{ $service->name }}</h3>
                    <p class="text-slate-500 text-sm mb-10 leading-relaxed">Join the queue for specialized assistance from our expert team.</p>
                    
                    <div class="mt-auto pt-8 border-t border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="block text-xs text-slate-400 font-semibold mb-1">Current Wait</span>
                            <span class="text-xl font-bold text-slate-900">{{ $service->average_time }} <span class="text-xs text-slate-500 font-medium">min</span></span>
                        </div>
                        <div class="w-12 h-12 rounded-full border border-gray-200/60 bg-[#f4f6f8] flex items-center justify-center group-hover:bg-[#e2e8f0] group-hover:border-slate-300/50 transition-colors duration-300">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                </button>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-[2.5rem] border border-gray-200/60 shadow-sm">
                    <div class="w-20 h-20 bg-[#f4f6f8] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <p class="text-slate-600 text-sm font-bold tracking-tight">Systems Offline • No Services Available</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
