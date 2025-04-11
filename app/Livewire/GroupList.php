<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Group;
use Livewire\WithPagination;

class GroupList extends Component
{
    use WithPagination;

    public $group_name, $port, $multicast_address;
    public $showForm = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'group_name' => 'required|string|max:255',
        'port' => 'required|string|max:10',
        'multicast_address' => 'required|string|max:20',
    ];

    public function createGroup()
    {
        $this->reset(['group_name', 'port', 'multicast_address']);
        $this->showForm = true;
    }

    public function hideGroupForm()
    {
        $this->reset(['group_name', 'port', 'multicast_address']);
        $this->showForm = false;
    }

    public function saveGroup()
    {
        $this->validate();

        Group::create([
            'group_name' => $this->group_name,
            'port' => $this->port,
            'multicast_address' => $this->multicast_address,
        ]);

        $this->reset(['group_name', 'port', 'multicast_address', 'showForm']);
        session()->flash('message', 'Group created successfully.');
    }

    public function delete($id)
    {
        Group::findOrFail($id)->delete();
        session()->flash('message', 'Group deleted.');
    }

    public function render()
    {
        $data = Group::latest()->paginate(10);
        return view('livewire.group-list', compact('data'));
    }
}
