<div class="min-h-screen bg-[#030712] flex flex-col items-center justify-center p-8 text-slate-200 font-sans relative overflow-hidden">
    <!-- Subtle Background Accents -->
    <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-indigo-500/5 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-blue-500/5 blur-[120px] rounded-full pointer-events-none"></div>

    <!-- Professional Top Navigation -->
    <div class="absolute top-10 right-10 z-20">
        <a href="{{ route('login') }}" class="group px-6 py-2.5 bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-full text-slate-400 hover:text-white hover:border-white/20 transition-all text-[11px] font-bold uppercase tracking-[0.2em] flex items-center">
            <svg class="w-3.5 h-3.5 mr-2.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            Staff Portal
        </a>
    </div>

    <div class="max-w-5xl w-full relative z-10">
        <div class="text-center mb-20">
            <div class="inline-flex items-center px-4 py-1.5 mb-8 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-bold uppercase tracking-[0.2em]">
                Integrated Intelligence
            </div>
            <h1 class="text-6xl md:text-8xl font-black mb-8 tracking-tighter text-white font-['Outfit']">
                Queue<span class="text-indigo-500">Sense</span>
            </h1>
            <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed font-light">
                Premium queue management for modern organizations. Select a service to receive your digital ticket and real-time updates.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($services as $service)
                <button wire:click="takeTicket({{ $service->id }})" 
                    class="group relative flex flex-col h-full bg-white/[0.02] backdrop-blur-2xl border border-white/5 rounded-[2rem] p-10 text-left transition-all duration-500 hover:bg-white/[0.04] hover:border-white/10 hover:-translate-y-2 hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.5)]">
                    
                    <div class="w-16 h-16 rounded-2xl bg-indigo-500/10 flex items-center justify-center mb-10 group-hover:bg-indigo-500 group-hover:text-white transition-all duration-500 border border-indigo-500/20">
                        <svg class="w-8 h-8 text-indigo-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>

                    <h3 class="text-2xl font-bold text-white mb-4 font-['Outfit'] tracking-tight group-hover:text-indigo-400 transition-colors">{{ $service->name }}</h3>
                    <p class="text-slate-500 text-sm mb-10 leading-relaxed font-normal">Connect with our dedicated specialists for personalized assistance and support.</p>
                    
                    <div class="mt-auto pt-8 border-t border-white/5 flex items-end justify-between">
                        <div>
                            <span class="block text-[10px] uppercase tracking-[0.2em] text-slate-600 font-bold mb-2">Wait Time</span>
                            <div class="flex items-baseline gap-1">
                                <span class="text-2xl font-bold text-white">{{ $service->average_time }}</span>
                                <span class="text-xs text-slate-500 font-medium">MINS</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center group-hover:border-indigo-500/50 group-hover:bg-indigo-500/10 transition-all duration-500">
                            <svg class="w-5 h-5 text-slate-500 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </button>
            @empty
                <div class="col-span-full text-center py-24 bg-white/[0.02] rounded-[2.5rem] border border-dashed border-white/10">
                    <p class="text-slate-500 text-lg font-light tracking-wide">Systems Offline • No services available</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
