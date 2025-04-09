<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Withpagination;

class AdminMenu extends Component
{
    use WithPagination;
    public $users;
    protected $paginationTheme = 'bootstrap';

    public function mount() // โหลดข้อมูลผู้ใช้
    {
        $this->users = User::all(); // โหลดข้อมูลผู้ใช้ทั้งหมด
    }

    public function render()
    {
        $data = User::paginate(10);
        return view('livewire.admin-menu')->with(compact('data'));
    }
}
