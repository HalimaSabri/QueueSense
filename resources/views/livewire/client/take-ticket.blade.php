<div class="min-h-screen bg-[#0a0a0a] flex flex-col items-center justify-center p-6 text-slate-300 font-sans">
    <!-- Professional Top Navigation -->
    <div class="absolute top-8 right-8 z-20">
        <a href="{{ route('login') }}" class="group px-5 py-2 bg-[#1a1a1a] border border-white/5 rounded-full text-slate-400 hover:text-white hover:border-white/10 transition-all text-[10px] font-semibold uppercase tracking-widest flex items-center">
            Staff Portal
        </a>
    </div>

    <div class="max-w-5xl w-full">
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 tracking-tight text-white font-['Outfit']">
                Queue<span class="text-indigo-500">Sense</span>
            </h1>
            <p class="text-slate-500 text-lg max-w-xl mx-auto leading-relaxed">
                Select a service below to join the digital queue and receive your ticket.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($services as $service)
                <button wire:click="takeTicket({{ $service->id }})" 
                    class="group relative flex flex-col h-full bg-[#161616] border border-white/5 rounded-3xl p-8 text-left transition-all duration-300 hover:border-indigo-500/50 hover:bg-[#1c1c1c]">
                    
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/10 flex items-center justify-center mb-6 group-hover:bg-indigo-500 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6 text-indigo-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>

                    <h3 class="text-xl font-bold text-white mb-3 font-['Outfit']">{{ $service->name }}</h3>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">Join the queue for specialized assistance from our team.</p>
                    
                    <div class="mt-auto pt-6 border-t border-white/5 flex items-center justify-between">
                        <div>
                            <span class="block text-[10px] uppercase tracking-wider text-slate-600 font-bold mb-1">Wait Time</span>
                            <span class="text-lg font-bold text-white">{{ $service->average_time }} <span class="text-[10px] text-slate-500 uppercase">min</span></span>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center group-hover:border-indigo-500/50 transition-all duration-300">
                            <svg class="w-4 h-4 text-slate-500 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                </button>
            @empty
                <div class="col-span-full text-center py-20 bg-[#161616] rounded-3xl border border-dashed border-white/5">
                    <p class="text-slate-600 text-sm uppercase tracking-widest font-bold">No Services Available</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
