<div class="min-h-screen bg-slate-50 flex flex-col items-center justify-center p-6 text-slate-900 font-sans">
    <!-- Professional Top Navigation -->
    <div class="absolute top-8 right-8 z-20">
        <a href="{{ route('login') }}" class="group px-5 py-2 bg-white border border-slate-200 rounded-full text-slate-600 hover:text-indigo-600 hover:border-indigo-600 transition-all text-[10px] font-bold uppercase tracking-widest flex items-center shadow-sm">
            Staff Portal
        </a>
    </div>

    <div class="max-w-5xl w-full">
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 tracking-tight text-slate-900 font-['Outfit']">
                Queue<span class="text-indigo-600">Sense</span>
            </h1>
            <p class="text-slate-600 text-lg max-w-xl mx-auto leading-relaxed">
                Experience seamless service. Select a category below to receive your digital ticket.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($services as $service)
                <button wire:click="takeTicket({{ $service->id }})" 
                    class="group relative flex flex-col h-full bg-white border border-slate-200 rounded-3xl p-10 text-left transition-all duration-300 hover:border-indigo-600 hover:shadow-xl hover:shadow-indigo-500/10 hover:-translate-y-1">
                    
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center mb-8 group-hover:bg-indigo-100 transition-all duration-300">
                        <svg class="w-7 h-7 text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>

                    <h3 class="text-2xl font-bold text-slate-900 mb-4 font-['Outfit']">{{ $service->name }}</h3>
                    <p class="text-slate-600 text-sm mb-10 leading-relaxed">Join the queue for specialized assistance from our expert team.</p>
                    
                    <div class="mt-auto pt-8 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="block text-[10px] uppercase tracking-wider text-slate-500 font-bold mb-1">Current Wait</span>
                            <span class="text-xl font-bold text-slate-900">{{ $service->average_time }} <span class="text-[10px] text-slate-500 uppercase">min</span></span>
                        </div>
                        <div class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center group-hover:bg-slate-900 transition-all duration-300">
                            <svg class="w-5 h-5 text-slate-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                </button>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-dashed border-slate-200">
                    <p class="text-slate-600 text-sm uppercase tracking-widest font-bold">Systems Offline • No Services Available</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
