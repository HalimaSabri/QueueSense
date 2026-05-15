<div class="min-h-screen bg-slate-900 flex flex-col items-center justify-center p-6 text-white font-sans relative">
    <!-- Top Right Login Link -->
    <div class="absolute top-6 right-6">
        <a href="{{ route('login') }}" class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-slate-400 hover:text-white hover:bg-white/10 transition-all text-xs font-bold uppercase tracking-widest">
            Staff Login
        </a>
    </div>

    <div class="max-w-3xl w-full bg-slate-800/50 backdrop-blur-xl border border-white/10 p-10 rounded-3xl shadow-2xl">
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400 mb-4 text-center">
            Welcome to QueueSense
        </h1>
        <p class="text-slate-400 text-center mb-10 text-lg">Select a service to join the queue</p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @forelse($services as $service)
                <button wire:click="takeTicket({{ $service->id }})" 
                    class="group relative overflow-hidden rounded-2xl p-6 bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-emerald-500/20 hover:shadow-xl text-left w-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-emerald-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-emerald-400 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-white mb-2">{{ $service->name }}</h3>
                        <p class="text-sm text-slate-400">Average Wait: {{ $service->average_time }} mins</p>
                    </div>
                </button>
            @empty
                <div class="col-span-full text-center text-slate-400 py-10">
                    No services available at the moment. Please check back later.
                </div>
            @endforelse
        </div>
    </div>
</div>
