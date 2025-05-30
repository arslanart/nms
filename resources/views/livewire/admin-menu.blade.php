<div class="content-wrapper responsive">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrator</h1>
                </div>
                <div class="col-sm-6 text-right">
                    @if (!$showForm)
                        <button class="btn btn-success" wire:click="createUser">
                            <i class="fas fa-plus"></i> Add User
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($showForm)
        <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add User</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveUser">
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" id="username" wire:model="username" class="form-control"
                                placeholder="Enter username">
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select id="user_type" wire:model="user_type" class="form-control custom-select">
                                <option value="">Please Select Level</option>
                                <option value="Admin">Admin</option>
                                <option value="Viewer">Viewer</option>
                            </select>
                            @error('user_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" wire:model="email" class="form-control"
                                placeholder="Enter email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" wire:model="password" class="form-control"
                                placeholder="Enter password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="button" class="btn btn-danger" wire:click="hideUserForm">Cancel</button>
                    </form>
                </div>
            </div>
        </section>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped table-bordered">
                    <thead class="bg-dark-secondary text-dark">
                        <tr>
                            <th style="width: 10%" scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Username</th>
                            <th scope="col" class="text-center">Level</th>
                            <th scope="col" class="text-center">Email</th>
                            <th style="width: 12%" scope="col" class="text-center">Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data) && $data->isNotEmpty())
                            @foreach ($data as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->username }}</td>
                                    @if ($item->user_type == 'Admin')
                                        <td class=" role-admin">{{ $item->user_type }}</td>
                                    @else
                                        <td class=" role-viewer">{{ $item->user_type }}</td>
                                    @endif
                                    <td>{{ $item->email }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editUserModal" wire:click="editUser({{ $item->id }})">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @can('admin-delete')
                                            <button class="btn btn-danger btn-sm"
                                                wire:click.prevent="confirmDelete({{ $item->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No data available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $data->links() }}
            </div>
        </div>
    </section>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="false" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="updateUser">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" wire:model.defer="username" class="form-control">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" wire:model.defer="password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" wire:model.defer="email" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>User Type</label>
                            <select wire:model.defer="user_type" class="form-control">
                                <option value="">Select type</option>
                                <option value="Admin">Admin</option>
                                <option value="Viewer">Viewer</option>
                            </select>
                            @error('user_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- เพิ่มฟิลด์อื่นๆ ตามต้องการ -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('closeModal', () => {
            $('#editUserModal').modal('hide');
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการลบผู้ใช้งานนี้หรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteConfirmed');
                }
            });
        });

        // แสดง alert message
        window.addEventListener('alert', () => {
            Swal.fire({
                icon: 'success',
                title: 'ลบผู้ใช้สำเร็จ',
                timer: 1500,
                showConfirmButton: false,
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const message = document.getElementById('success-message');

        if (message) {
            // ใช้ fade out (Bootstrap ทำงาน)
            setTimeout(() => {
                message.classList.remove('show');
                message.classList.add('fade');
            }, 3000); // ปิดภายใน 3 วิ

            // Fallback: ลบออกจาก DOM เผื่อ .fade ไม่ทำงาน
            setTimeout(() => {
                if (message.parentElement) {
                    message.remove();
                }
            }, 5000); // ลบทิ้งภายใน 5 วิ
        }
    });
</script>
