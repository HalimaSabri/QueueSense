<div class="py-12 bg-white min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Minimal Header -->
        <div class="flex items-center justify-between mb-12 border-b border-slate-100 pb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight font-['Outfit']">Staff Control</h1>
                <p class="text-[11px] font-bold uppercase tracking-[0.1em] text-slate-400 mt-1">Personnel and Node Assignments</p>
            </div>
            
            <button wire:click="openModal" class="px-6 py-3 bg-white border border-slate-900 text-slate-900 text-[10px] font-bold uppercase tracking-widest rounded-lg hover:bg-slate-50 transition-all flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Provision Staff
            </button>
        </div>

        @if (session()->has('message'))
            <div class="bg-white border border-slate-900 text-slate-900 px-6 py-4 rounded-xl font-bold text-[11px] uppercase tracking-widest mb-10">
                {{ session('message') }}
            </div>
        @endif

        <!-- Minimal Table -->
        <div class="border border-slate-100 rounded-2xl overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Identity</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Role</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Service Node</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Operations</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($agents as $agent)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="text-sm font-bold text-slate-900">{{ $agent->name }}</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">{{ $agent->email }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-[10px] font-bold uppercase tracking-[0.2em] {{ $agent->role === 'admin' ? 'text-indigo-600' : 'text-slate-400' }}">
                                    {{ $agent->role }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-[11px] font-bold text-slate-600 uppercase tracking-widest">
                                    {{ $agent->service ? $agent->service->name : 'FLOAT' }}
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right space-x-4">
                                <button wire:click="edit({{ $agent->id }})" class="text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors">Edit</button>
                                <button wire:click="delete({{ $agent->id }})" wire:confirm="Confirm deletion?" class="text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-rose-600 transition-colors">Terminate</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $agents->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-slate-900/10 backdrop-blur-[2px]">
            <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900 font-['Outfit']">{{ $editingAgentId ? 'Update Identity' : 'Provision Staff' }}</h3>
                </div>
                
                <form wire:submit="store" class="p-8 space-y-6">
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Name</label>
                        <input wire:model="name" type="text" class="w-full bg-slate-50 border border-slate-100 rounded-lg px-4 py-3 text-slate-900 focus:ring-0 focus:border-slate-900 text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Email</label>
                        <input wire:model="email" type="email" class="w-full bg-slate-50 border border-slate-100 rounded-lg px-4 py-3 text-slate-900 focus:ring-0 focus:border-slate-900 text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Access Key</label>
                        <input wire:model="password" type="password" class="w-full bg-slate-50 border border-slate-100 rounded-lg px-4 py-3 text-slate-900 focus:ring-0 focus:border-slate-900 text-sm transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Role</label>
                            <select wire:model="role" class="w-full bg-slate-50 border border-slate-100 rounded-lg px-4 py-3 text-slate-900 focus:ring-0 focus:border-slate-900 text-sm transition-all">
                                <option value="agent">Agent</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Service</label>
                            <select wire:model="service_id" class="w-full bg-slate-50 border border-slate-100 rounded-lg px-4 py-3 text-slate-900 focus:ring-0 focus:border-slate-900 text-sm transition-all">
                                <option value="">Global</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end space-x-4">
                        <button type="button" wire:click="closeModal" class="text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-900">Cancel</button>
                        <button type="submit" class="px-6 py-3 bg-white border border-slate-900 text-slate-900 text-[10px] font-bold uppercase tracking-widest rounded-lg hover:bg-slate-50 transition-all">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
