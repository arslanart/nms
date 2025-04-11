<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Group; // นำเข้าโมเดล Group
use Livewire\Withpagination;


class GroupList extends Component
{
    public $group, $group_name, $port, $multicast_address; // ฟิลด์สำหรับชื่อกลุ่ม
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->group = Group::all();
    }

    public function render()
    {
        $data = Group::paginate(10);
        return view('livewire.group-list')->with(compact('data'));
    }
}
