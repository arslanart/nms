<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Withpagination;

class AdminMenu extends Component
{
    use WithPagination;
    public $users, $name, $email, $password, $user_type;
    protected $paginationTheme = 'bootstrap';
    public $showForm = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'user_type' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|string|min:8',
    ];

    public function createUser() // ฟังก์ชันสร้างผู้ใช้ใหม่
    {
        $this->reset(['name', 'email', 'password', 'user_type']);
        $this->showForm = true; // แสดงฟอร์มสร้างผู้ใช้
    }

    public function hideUserForm() // ฟังก์ชันซ่อนฟอร์มสร้างผู้ใช้
    {
        $this->reset(['name', 'email', 'password', 'user_type']);
        $this->showForm = false; // ซ่อนฟอร์มสร้างผู้ใช้
    }

    public function saveUser()
    {
        try {
            $this->validate();

            User::create([
                'name' => $this->name,
                'user_type' => $this->user_type,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            $this->reset(['name', 'email', 'password', 'user_type', 'showForm']);
            session()->flash('message', 'User created successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function mount() // โหลดข้อมูลผู้ใช้
    {
        $this->users = User::all(); // โหลดข้อมูลผู้ใช้ทั้งหมด
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'User deleted.');
    }


    public function render()
    {
        $data = User::paginate(10);
        return view('livewire.admin-menu')->with(compact('data'));
    }
}
