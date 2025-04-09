<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Group; // นำเข้าโมเดล Group
use Livewire\Withpagination;


class GroupsMenu extends Component
{
    public $group,$group_name, $port, $multicast_address; // ฟิลด์สำหรับชื่อกลุ่ม
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->group = Group::all();
    }

    public function saveGroup()
    {
        try {
            // ตรวจสอบข้อมูล
            $this->validate([
                'group_name' => 'required|string|max:255',
                'port' => 'required|string|max:10',
                'multicast_address' => 'required|string|max:20',
            ]);

            // บันทึกข้อมูลลงในตาราง group
            Group::create([
                'group_name' => $this->group_name,
                'port' => $this->port,
                'multicast_address' => $this->multicast_address,
            ]);

            // รีเซ็ตฟิลด์หลังจากบันทึกสำเร็จ
            $this->reset();

            // ส่งข้อความแจ้งเตือน
            session()->flash('message', 'Group created successfully.');
        } catch (\Exception $e) {
            // จัดการข้อผิดพลาดและส่งข้อความแจ้งเตือน
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $data = Group::paginate(10);
        return view('livewire.groups-menu')->with(compact('data'));
    }
}
