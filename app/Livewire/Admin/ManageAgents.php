<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class ManageAgents extends Component
{
    use WithPagination;

    public $name, $email, $password, $role = 'agent', $service_id;
    public $editingAgentId = null;
    public $isModalOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'role' => 'required|in:admin,agent',
        'service_id' => 'nullable|exists:services,id',
    ];

    public function openModal()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = 'agent';
        $this->service_id = null;
        $this->editingAgentId = null;
    }

    public function store()
    {
        $validationRules = $this->rules;
        if ($this->editingAgentId) {
            $validationRules['email'] = 'required|email|unique:users,email,' . $this->editingAgentId;
            $validationRules['password'] = 'nullable|min:8';
        }

        $this->validate($validationRules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'service_id' => $this->service_id,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->editingAgentId], $data);

        session()->flash('message', $this->editingAgentId ? 'Agent Updated Successfully.' : 'Agent Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $agent = User::findOrFail($id);
        $this->editingAgentId = $id;
        $this->name = $agent->name;
        $this->email = $agent->email;
        $this->role = $agent->role;
        $this->service_id = $agent->service_id;
        $this->password = ''; // Don't show password
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Agent Deleted Successfully.');
    }

    public function render()
    {
        return view('livewire.admin.manage-agents', [
            'agents' => User::latest()->paginate(10),
            'services' => Service::all(),
        ])->layout('layouts.app');
    }
}
