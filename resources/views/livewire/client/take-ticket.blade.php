<div class="min-h-screen bg-[#0f172a] flex flex-col items-center justify-center p-6 text-white font-sans relative overflow-hidden">
    <!-- Dynamic Background Elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-600/20 blur-[120px] rounded-full animate-pulse"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-emerald-600/20 blur-[120px] rounded-full animate-pulse" style="animation-delay: 2s;"></div>

    <!-- Top Right Login Link -->
    <div class="absolute top-8 right-8 z-20">
        <a href="{{ route('login') }}" class="group px-5 py-2.5 bg-white/5 backdrop-blur-md border border-white/10 rounded-full text-slate-400 hover:text-white hover:border-white/20 transition-all text-xs font-bold uppercase tracking-widest flex items-center">
            <svg class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            Staff Login
        </a>
    </div>

    <div class="max-w-4xl w-full relative z-10">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-1.5 mb-6 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-sm font-medium tracking-wide animate-bounce">
                🚀 Smart Queue Management
            </div>
            <h1 class="text-5xl md:text-7xl font-black mb-6 tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-400 to-emerald-400">
                    QueueSense
                </span>
            </h1>
            <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                Experience the future of service. Digitalize your wait, track your progress, and save your time with our AI-powered platform.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($services as $service)
                <button wire:click="takeTicket({{ $service->id }})" 
                    class="group relative overflow-hidden rounded-3xl p-8 bg-slate-800/40 backdrop-blur-xl border border-white/5 hover:border-white/20 transition-all duration-500 transform hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(8,_112,_184,_0.2)] text-left flex flex-col h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center mb-8 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>

                    <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-blue-400 transition-colors">{{ $service->name }}</h3>
                    <p class="text-slate-400 text-sm mb-8 leading-relaxed">Join the queue for specialized assistance from our expert agents.</p>
                    
                    <div class="mt-auto pt-6 border-t border-white/5 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-[10px] uppercase tracking-widest text-slate-500 font-bold mb-1">Estimated Wait</span>
                            <span class="text-emerald-400 font-bold">{{ $service->average_time }} mins</span>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-all duration-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </button>
            @empty
                <div class="col-span-full text-center py-20 bg-slate-800/20 rounded-3xl border border-dashed border-slate-700">
                    <p class="text-slate-500 text-lg">No services currently available.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
