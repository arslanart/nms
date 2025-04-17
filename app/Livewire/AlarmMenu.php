<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Alarm;
use Livewire\Withpagination;

class AlarmMenu extends Component
{
    use WithPagination;
    public $alarms;
    protected $paginationTheme = 'bootstrap';

    public function mount() // โหลดข้อมูลผู้ใช้
    {
        $this->alarms = Alarm::all(); // โหลดข้อมูลผู้ใช้ทั้งหมด
    }

    public function render()
    {
        $data = Alarm::paginate(10);
        return view('livewire.alarm-menu')->with(compact('data'));
    }
}
