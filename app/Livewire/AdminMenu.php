<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Withpagination;

class AdminMenu extends Component
{
    use WithPagination;
    public $users, $username, $email, $password, $user_type, $viewUser= [];
    protected $paginationTheme = 'bootstrap';
    public $showForm = false;
    public $editUser = [];
public $editUserId;


    protected $rules = [
        'username' => 'required|string|max:255',
        'user_type' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|string|min:8',
    ];

    public function loadUser($id)
{
    $user = \App\Models\User::findOrFail($id);
    $this->viewUser = $user->toArray();
}

    public function createUser() // ฟังก์ชันสร้างผู้ใช้ใหม่
    {
        $this->reset(['username', 'email', 'password', 'user_type']);
        $this->showForm = true; // แสดงฟอร์มสร้างผู้ใช้
    }

    public function editUser($id)
{
    $this->editUserId = $id;
    $user = \App\Models\User::findOrFail($id);
    $this->editUser = $user->toArray();
}

public function updateUser()
{
    $this->validate([
        'editUser.username' => 'required|string|max:255',
        'editUser.password' => 'required|string|max:255',
        'editUser.email' => 'required|email|max:255|unique:users,email,' . $this->editUserId,
        'editUser.user_type' => 'required|string',
        // เพิ่ม field เพิ่มเติมถ้าจำเป็น
    ]);

    $user = \App\Models\User::findOrFail($this->editUserId);
    $user->update($this->editUser);

    session()->flash('message', 'User updated successfully.');
    $this->dispatch('close-modal');
}


    public function hideUserForm() // ฟังก์ชันซ่อนฟอร์มสร้างผู้ใช้
    {
        $this->reset(['username', 'email', 'password', 'user_type']);
        $this->showForm = false; // ซ่อนฟอร์มสร้างผู้ใช้
    }

    public function saveUser()
    {
        try {
            $this->validate();

            User::create([
                'username' => $this->username,
                'user_type' => $this->user_type,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            $this->reset(['username', 'email', 'password', 'user_type', 'showForm']);
            session()->flash('message', 'User created successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
        }
        // dd($this->username, $this->email, $this->password, $this->user_type);
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
