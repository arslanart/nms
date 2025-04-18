<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use Livewire\WithPagination;

class InventoryMenu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $inventory = [];
    public $showForm = false;

    private function resetInventory()
    {
        $this->inventory = [
            'inventory_name' => '',
            'region' => '',
            'connection_type' => '',
            'port_info' => '',
            'city_location' => '',
            'building_name' => '',
            'floor' => '',
            'room_name' => '',
            'installation_date' => '',
            'asset_code' => '',
            'contractor_company' => '',
            'contractor_number' => '',
            'warranty_expiration_date' => '',
            'ip_address' => '',
            'mac_address' => '',
            'gateway' => '',
            'subnet_mask' => '',
            'hardware_serial_number' => '',
            'software_version' => '',
            'device_status' => '',
        ];
    }


    public function createInventory()
    {
        $this->resetInventory();
        $this->showForm = true;
        $this->resetPage();
    }

    public function hideInventoryForm()
    {
        $this->resetInventory();
        $this->showForm = false;
    }

    public function saveInventory()
    {
        $this->validate([
            'inventory.inventory_name' => 'required|string|max:255',
            'inventory.region' => 'required|string|max:255',
            'inventory.connection_type' => 'required|string|max:255',
            'inventory.port_info' => 'required|string|max:255',
            'inventory.city_location' => 'required|string|max:255',
            'inventory.building_name' => 'required|string|max:255',
            'inventory.floor' => 'required|string|max:255',
            'inventory.room_name' => 'required|string|max:255',
            'inventory.installation_date' => 'required|date',
            'inventory.asset_code' => 'required|string|max:255',
            'inventory.contractor_company' => 'required|string|max:255',
            'inventory.contractor_number' => 'required|string|max:255',
            'inventory.warranty_expiration_date' => 'required|string|max:255',
            'inventory.ip_address' => 'required|string|max:255',
            'inventory.mac_address' => 'required|string|max:255',
            'inventory.gateway' => 'required|string|max:255',
            'inventory.subnet_mask' => 'required|string|max:255',
            'inventory.hardware_serial_number' => 'required|string|max:255',
            'inventory.software_version' => 'required|string|max:255',
            'inventory.device_status' => 'required|string|max:255',
        ]);

        Inventory::create($this->inventory);

        $this->inventory = [
            'inventory_name' => '',
            'region' => '',
            'connection_type' => '',
            'port_info' => '',
            'city_location' => '',
            'building_name' => '',
            'floor' => '',
            'room_name' => '',
            'installation_date' => '',
            'asset_code' => '',
            'contractor_company' => '',
            'contractor_number' => '',
            'warranty_expiration_date' => '',
            'ip_address' => '',
            'mac_address' => '',
            'gateway' => '',
            'subnet_mask' => '',
            'hardware_serial_number' => '',
            'software_version' => '',
            'device_status' => '',
        ];
        $this->showForm = false;
        session()->flash('message', 'Inventory created successfully.');
    }

    public function delete($id)
    {
        Inventory::findOrFail($id)->delete();
        session()->flash('message', 'Inventory deleted.');
    }

    public function mount()
    {
        $this->resetInventory();
    }

    public function render()
    {
        $data = Inventory::paginate(10);
        return view('livewire.inventory-menu')->with(compact('data'));
    }
}
