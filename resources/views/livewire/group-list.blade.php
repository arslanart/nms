<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Group</h1>
                </div>
                @can('admin-create-group')
                    <div class="col-sm-6 text-right">
                        @if (!$showForm)
                            <button class="btn btn-success" wire:click="createGroup">
                                <i class="fas fa-plus"></i> Add Group
                            </button>
                        @endif
                    </div>
                @endcan
            </div>
        </div>
    </section>

    <!-- แสดงข้อความแจ้งเตือน -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form เพิ่มข้อมูล -->
    @if ($showForm)
        <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Group</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveGroup">
                        <div class="form-group">
                            <label for="group_name">Group Name</label>
                            <input type="text" wire:model="group_name" class="form-control"
                                placeholder="Enter group name">
                            @error('group_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="port">Port</label>
                            <input type="text" wire:model="port" class="form-control" placeholder="Enter port">
                            @error('port')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="multicast_address">Multicast Address</label>
                            <input type="text" wire:model="multicast_address" class="form-control"
                                placeholder="Enter multicast address">
                            @error('multicast_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="button" class="btn btn-danger" wire:click="hideGroupForm">
                            Cancel
                        </button>
                    </form>
                </div>
            </div>
        </section>
    @endif

    <!-- ตารางข้อมูล -->
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped table-bordered">
                    <thead class="bg-dark-secondary text-dark">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Group</th>
                            <th class="text-center">Multicast address</th>
                            <th class="text-center">Port</th>
                            <th class="text-center">Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $item)
                            <tr>
                                <td class="text-center">{{ $data->firstItem() + $index }}</td>
                                <td class="text-center">{{ $item->group_name }}</td>
                                <td class="text-center">{{ $item->multicast_address }}</td>
                                <td class="text-center">{{ $item->port }}</td>
                                <td class="text-center">
                                    <a href="{{ route('profile-view', ['id' => $item->id]) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('admin-edit-menu')
                                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editGroupModal" wire:click="editGroup({{ $item->id }})">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm"
                                            wire:click.prevent="confirmDelete({{ $item->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>

    <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="false" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="updateGroup">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Group</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Group Name</label>
                            <input type="text" wire:model.defer="group_name" class="form-control">
                            @error('group_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Port</label>
                            <input type="text" wire:model.defer="port" class="form-control">
                            @error('port')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Multicast Address</label>
                            <input type="text" wire:model.defer="multicast_address" class="form-control">
                            @error('multicast_address')
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
        Livewire.on('closeGroupModal', () => {
            $('#editGroupModal').modal('hide');
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการลบกลุ่มนี้หรือไม่",
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
