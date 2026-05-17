<div class="py-12 w-full">
    <div class="max-w-[85rem] mx-auto px-6 lg:px-8 space-y-10">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div>
                <h1 class="text-[2.25rem] font-bold text-slate-900 leading-tight tracking-tight">Staff Control</h1>
                <p class="text-slate-500 text-sm font-medium leading-relaxed mt-1">Manage personnel and service node assignments.</p>
            </div>
            
            <button wire:click="openModal" class="px-8 py-4 bg-[#1c1c1e] text-white text-xs font-bold uppercase tracking-widest rounded-2xl hover:bg-black transition-all flex items-center shadow-lg shadow-black/10">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Provision Staff
            </button>
        </div>

        @if (session()->has('message'))
            <div class="bg-[#1c1c1e] text-white px-6 py-4 rounded-2xl font-bold text-[11px] uppercase tracking-widest shadow-lg">
                {{ session('message') }}
            </div>
        @endif

        <!-- Agents List (Premium Custom Style) -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-200/60 p-8 flex flex-col min-h-[500px]">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight">Active Personnel</h3>
                <span class="text-xs font-bold bg-[#f4f6f8] text-slate-800 px-3 py-1.5 rounded-lg">{{ $agents->total() }} Users</span>
            </div>

            <div class="flex-1 space-y-2">
                @forelse($agents as $agent)
                    <!-- List Item -->
                    <div class="flex items-center justify-between p-4 rounded-2xl hover:bg-[#f4f6f8] transition-colors group">
                        <div class="flex items-center space-x-5">
                            <!-- Avatar Circle -->
                            <div class="w-12 h-12 rounded-[1rem] bg-[#1c1c1e] text-white flex items-center justify-center font-bold text-xl shadow-sm">
                                {{ substr($agent->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 text-lg leading-tight flex items-center gap-3">
                                    {{ $agent->name }}
                                    @if($agent->role === 'admin')
                                        <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded-md text-[9px] uppercase tracking-widest font-black">Admin</span>
                                    @endif
                                </p>
                                <p class="text-xs text-slate-500 font-medium mt-0.5">{{ $agent->email }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-12">
                            <!-- Service Node -->
                            <div class="hidden md:block text-right">
                                <p class="text-sm font-bold text-slate-900">{{ $agent->service ? $agent->service->name : 'Global Float' }}</p>
                                <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider mt-1">Assigned Node</p>
                            </div>

                            <!-- Operations -->
                            <div class="flex items-center space-x-4">
                                <button wire:click="edit({{ $agent->id }})" class="p-2.5 bg-white border border-gray-200 rounded-xl text-slate-400 hover:text-[#1c1c1e] hover:border-slate-400 transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button wire:click="delete({{ $agent->id }})" wire:confirm="Terminate session?" class="p-2.5 bg-white border border-gray-200 rounded-xl text-slate-400 hover:text-rose-600 hover:border-rose-200 transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center h-48 text-slate-400 space-y-4">
                        <div class="w-16 h-16 rounded-[1.25rem] bg-slate-50 flex items-center justify-center border border-gray-100">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <p class="text-sm font-bold tracking-tight">No personnel records found</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100">
                {{ $agents->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-slate-900/20 backdrop-blur-sm">
            <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl border border-gray-200/60 overflow-hidden">
                <div class="px-10 py-8 border-b border-gray-100 flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-[1rem] bg-[#f4f6f8] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#1c1c1e]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 font-['Outfit'] tracking-tight">{{ $editingAgentId ? 'Update Identity' : 'Provision Staff' }}</h3>
                </div>
                
                <form wire:submit="store" class="p-10 space-y-6">
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Display Name</label>
                        <input wire:model="name" type="text" class="w-full bg-[#f4f6f8] border border-gray-200/60 rounded-2xl px-6 py-4 text-slate-900 focus:border-[#1c1c1e] focus:ring-0 text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Email Address</label>
                        <input wire:model="email" type="email" class="w-full bg-[#f4f6f8] border border-gray-200/60 rounded-2xl px-6 py-4 text-slate-900 focus:border-[#1c1c1e] focus:ring-0 text-sm font-medium">
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Access Role</label>
                            <select wire:model="role" class="w-full bg-[#f4f6f8] border border-gray-200/60 rounded-2xl px-6 py-4 text-slate-900 focus:border-[#1c1c1e] focus:ring-0 text-sm font-medium appearance-none">
                                <option value="agent">Agent</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Node</label>
                            <select wire:model="service_id" class="w-full bg-[#f4f6f8] border border-gray-200/60 rounded-2xl px-6 py-4 text-slate-900 focus:border-[#1c1c1e] focus:ring-0 text-sm font-medium appearance-none">
                                <option value="">Global Float</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pt-6 flex items-center justify-between">
                        <button type="button" wire:click="closeModal" class="text-xs font-bold text-slate-400 hover:text-slate-900 transition-colors">Cancel</button>
                        <button type="submit" class="px-8 py-4 bg-[#1c1c1e] text-white text-[11px] font-bold uppercase tracking-widest rounded-2xl hover:bg-black transition-all shadow-lg shadow-black/10">
                            Save Identity
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
