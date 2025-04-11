<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use Livewire\WithPagination;

class InventoryMenu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $inventory;

    public function mount()
    {
        $this->inventory = Inventory::all();
    }

    public function render()
    {
        $data = Inventory::paginate(10);
        return view('livewire.inventory-menu')->with(compact('data'));
    }
}
