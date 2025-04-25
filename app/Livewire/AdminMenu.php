<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Withpagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMenu extends Component
{
    use WithPagination;
    public $users, $username, $email, $password, $user_type, $viewUser = [];
    protected $paginationTheme = 'bootstrap';
    public $showForm = false;
    public $editUserId;
    public $delete_id;
    protected $listeners = ['deleteConfirmed'];



    protected $rules = [
        'username' => 'required|string|max:255',
        'user_type' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|string|min:8',
    ];

    public function loadUser($id)
    {
        $user = User::findOrFail($id);
        $this->viewUser = $user->toArray();
    }

    public function createUser() // ฟังก์ชันสร้างผู้ใช้ใหม่
    {
        $this->reset(['username', 'email', 'password', 'user_type']);
        $this->showForm = true; // แสดงฟอร์มสร้างผู้ใช้
    }

    public function editUser($id)
    {
        try {
            $this->editUserId = $id;
            $user = User::findOrFail($id);

            $this->username = $user->username;
            $this->email = $user->email;
            $this->user_type = $user->user_type;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function updateUser()
    {
        $this->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->editUserId,
            'user_type' => 'required|string|max:255',
        ]);

        try {
            $user = User::findOrFail($this->editUserId);

            $user->update([
                'username' => $this->username,
                'email' => $this->email,
                'user_type' => $this->user_type,
            ]);

            session()->flash('message', 'User updated successfully.');

            // รีเซ็ตข้อมูลฟอร์ม
            $this->reset(['username', 'email', 'password', 'user_type', 'editUserId']);

            // ซ่อน modal (ถ้าใช้ JS จัดการ modal)
            $this->dispatch('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    public function confirmDelete($id)
{
    $this->delete_id = $id;

    // ส่ง Event ไปให้ JavaScript เพื่อแสดง SweetAlert
    $this->dispatch('show-delete-confirmation');
}
public function deleteConfirmed()
{
    $user = User::find($this->delete_id);

    if ($user) {
        $user->delete();

        Log::info('Deleting User ID: ' . $this->delete_id);

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'ลบผู้ใช้งานเรียบร้อยแล้ว'
        ]);
    } else {
        $this->dispatch('alert', [
            'type' => 'error',
            'message' => 'ไม่พบผู้ใช้งานที่ต้องการลบ'
        ]);
    }
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
            ]);

            // $this->reset(['username', 'email', 'password', 'user_type', 'showForm']);
            session()->flash('message', 'User created successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
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
