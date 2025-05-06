<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Group;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class GroupList extends Component
{
    use WithPagination;

    public $group_name, $port, $multicast_address, $group;
    public $showForm = false;

    protected $paginationTheme = 'bootstrap';
    public $delete_id;
    public $editGroupId;
    protected $listeners = ['deleteConfirmed'];

    protected $rules = [
        'group_name' => 'required|string|max:255',
        'port' => 'required|string|max:10',
        'multicast_address' => 'required|string|max:20',
    ];

    public function editGroup($id)
    {
        try {
            // ดึงข้อมูลกลุ่มจากฐานข้อมูล
            $group = Group::findOrFail($id);

            // ตั้งค่าข้อมูลในฟอร์ม
            $this->editGroupId = $id;
            $this->group_name = $group->group_name;
            $this->port = $group->port;
            $this->multicast_address = $group->multicast_address;

            // แสดงฟอร์มแก้ไข
            // $this->showForm = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading group: ' . $e->getMessage());
        }
    }

    public function updateGroup()
    {
        try {
            // ตรวจสอบข้อมูล
            $this->validate();

            // ดึงข้อมูลกลุ่มที่ต้องการแก้ไข
            $group = Group::findOrFail($this->editGroupId);

            // อัปเดตข้อมูล
            $group->update([
                'group_name' => $this->group_name,
                'port' => $this->port,
                'multicast_address' => $this->multicast_address,
            ]);

            // รีเซ็ตฟอร์มและซ่อนฟอร์มแก้ไข
            $this->reset(['group_name', 'port', 'multicast_address', 'editGroupId', 'showForm']);
            session()->flash('message', 'Group updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating group: ' . $e->getMessage());
        }
    }

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

    public function confirmDelete($id)
    {
        $this->delete_id = $id;

        // ส่ง Event ไปให้ JavaScript เพื่อแสดง SweetAlert
        $this->dispatch('show-delete-confirmation');
    }

    public function deleteConfirmed()
    {
        $group = Group::find($this->delete_id);

        if ($group) {
            $group->delete();

            Log::info('Deleting User ID: ' . $this->delete_id);

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'ลบกลุ่มเรียบร้อยแล้ว'
            ]);
        } else {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'ไม่พบกลุ่มที่ต้องการลบ'
            ]);
        }
    }

    public function render()
    {
        $data = Group::latest()->paginate(10);
        return view('livewire.group-list', compact('data'));
    }
}
