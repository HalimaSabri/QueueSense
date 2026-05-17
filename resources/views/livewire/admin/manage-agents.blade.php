<div class="py-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-6 space-y-10">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight font-['Outfit']">Staff Control</h1>
                <p class="mt-2 text-slate-500 font-medium leading-relaxed">Manage personnel and service node assignments.</p>
            </div>
            
            <button wire:click="openModal" class="px-8 py-4 bg-white border-2 border-slate-900 text-slate-900 text-[11px] font-bold uppercase tracking-widest rounded-2xl hover:bg-slate-50 transition-all flex items-center shadow-xl shadow-slate-200/50">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Provision Staff
            </button>
        </div>

        @if (session()->has('message'))
            <div class="bg-white border border-slate-200 text-slate-900 px-6 py-4 rounded-2xl font-bold text-[11px] uppercase tracking-widest shadow-sm">
                {{ session('message') }}
            </div>
        @endif

        <!-- Agents Table -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-10 py-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Identity</th>
                        <th class="px-10 py-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Role</th>
                        <th class="px-10 py-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Service Node</th>
                        <th class="px-10 py-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Operations</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($agents as $agent)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-10 py-6">
                                <div class="text-sm font-bold text-slate-900">{{ $agent->name }}</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">{{ $agent->email }}</div>
                            </td>
                            <td class="px-10 py-6">
                                <span class="px-3 py-1 bg-slate-50 border border-slate-200 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $agent->role === 'admin' ? 'text-indigo-600' : 'text-slate-500' }}">
                                    {{ $agent->role }}
                                </span>
                            </td>
                            <td class="px-10 py-6">
                                <div class="text-[11px] font-bold text-slate-700 uppercase tracking-widest">
                                    {{ $agent->service ? $agent->service->name : 'FLOAT' }}
                                </div>
                            </td>
                            <td class="px-10 py-6 text-right space-x-6">
                                <button wire:click="edit({{ $agent->id }})" class="text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors">Edit</button>
                                <button wire:click="delete({{ $agent->id }})" wire:confirm="Terminate session?" class="text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-rose-600 transition-colors">Terminate</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-10 py-6 bg-slate-50/50">
                {{ $agents->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-slate-900/10 backdrop-blur-[2px]">
            <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl border border-slate-200 overflow-hidden">
                <div class="px-10 py-8 border-b border-slate-100">
                    <h3 class="text-2xl font-black text-slate-900 font-['Outfit'] tracking-tight">{{ $editingAgentId ? 'Update Identity' : 'Provision Staff' }}</h3>
                </div>
                
                <form wire:submit="store" class="p-10 space-y-8">
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Display Name</label>
                        <input wire:model="name" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:border-indigo-600 focus:ring-0 text-sm">
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Email Address</label>
                        <input wire:model="email" type="email" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:border-indigo-600 focus:ring-0 text-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Access Role</label>
                            <select wire:model="role" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:border-indigo-600 focus:ring-0 text-sm">
                                <option value="agent">Agent</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-2">Node</label>
                            <select wire:model="service_id" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:border-indigo-600 focus:ring-0 text-sm">
                                <option value="">Global</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end space-x-6">
                        <button type="button" wire:click="closeModal" class="text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-900">Cancel</button>
                        <button type="submit" class="px-8 py-4 bg-white border-2 border-slate-900 text-slate-900 text-[11px] font-bold uppercase tracking-widest rounded-2xl hover:bg-slate-50 transition-all">
                            Save Identity
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
