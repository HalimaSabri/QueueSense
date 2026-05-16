<div class="py-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-10">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight font-['Outfit']">Staff Management</h1>
                <p class="mt-2 text-slate-600 font-medium">Provision and manage agent assignments across services.</p>
            </div>
            
            <button wire:click="openModal" class="px-8 py-4 bg-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-500/20 hover:bg-indigo-700 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-[11px] flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Add New Staff
            </button>
        </div>

        @if (session()->has('message'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm shadow-sm">
                {{ session('message') }}
            </div>
        @endif

        <!-- Agents Table -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-10 py-6 text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em]">Identity</th>
                        <th class="px-10 py-6 text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em]">Role</th>
                        <th class="px-10 py-6 text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em]">Assigned Service</th>
                        <th class="px-10 py-6 text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em]">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($agents as $agent)
                        <tr class="hover:bg-slate-50/30 transition-colors">
                            <td class="px-10 py-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold font-['Outfit']">
                                        {{ substr($agent->name, 0, 1) }}
                                    </div>
                                    <div class="ms-4">
                                        <div class="text-sm font-bold text-slate-900">{{ $agent->name }}</div>
                                        <div class="text-[11px] text-slate-600 font-medium">{{ $agent->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-6">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $agent->role === 'admin' ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                    {{ $agent->role }}
                                </span>
                            </td>
                            <td class="px-10 py-6">
                                @if($agent->service)
                                    <div class="flex items-center text-sm font-bold text-slate-700">
                                        <div class="w-2 h-2 rounded-full bg-emerald-500 mr-2.5"></div>
                                        {{ $agent->service->name }}
                                    </div>
                                @else
                                    <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest italic">Unassigned</span>
                                @endif
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex items-center space-x-4">
                                    <button wire:click="edit({{ $agent->id }})" class="p-2 text-slate-600 hover:text-indigo-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button wire:click="delete({{ $agent->id }})" wire:confirm="Are you sure you want to delete this staff member?" class="p-2 text-slate-600 hover:text-rose-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
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
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-slate-900/40 backdrop-blur-sm">
            <div class="bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl border border-slate-200 overflow-hidden">
                <div class="px-10 py-8 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-2xl font-extrabold text-slate-900 font-['Outfit'] tracking-tight">{{ $editingAgentId ? 'Update Staff Profile' : 'New Staff Provisioning' }}</h3>
                    <button wire:click="closeModal" class="text-slate-600 hover:text-slate-900 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <form wire:submit="store" class="p-10 space-y-8">
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-600 mb-2">Display Name</label>
                        <input wire:model="name" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" placeholder="Full Name">
                        @error('name') <span class="text-rose-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-600 mb-2">Email Identity</label>
                        <input wire:model="email" type="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" placeholder="email@queuesense.io">
                        @error('email') <span class="text-rose-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-600 mb-2">Access Key {{ $editingAgentId ? '(Leave blank to keep current)' : '' }}</label>
                        <input wire:model="password" type="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" placeholder="••••••••">
                        @error('password') <span class="text-rose-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-600 mb-2">Security Role</label>
                            <select wire:model="role" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm">
                                <option value="agent">Agent</option>
                                <option value="admin">Administrator</option>
                            </select>
                            @error('role') <span class="text-rose-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-bold text-slate-600 mb-2">Service Node</label>
                            <select wire:model="service_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm">
                                <option value="">Global / Float</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                            @error('service_id') <span class="text-rose-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end space-x-4">
                        <button type="button" wire:click="closeModal" class="px-8 py-4 bg-slate-50 text-slate-600 font-bold rounded-xl hover:bg-slate-100 transition-all uppercase tracking-widest text-[10px]">Cancel</button>
                        <button type="submit" class="px-8 py-4 bg-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition-all uppercase tracking-widest text-[10px]">
                            {{ $editingAgentId ? 'Commit Changes' : 'Provision Staff' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
