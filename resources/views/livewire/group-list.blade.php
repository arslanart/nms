<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Group</h1>
                </div>
                <div class="col-sm-6 text-right">
                    @if (!$showForm)
                        <button class="btn btn-success" wire:click="createGroup">
                            <i class="fas fa-plus"></i> Add Group
                        </button>
                    @endif
                </div>
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
                            <input type="text" wire:model="group_name" class="form-control" placeholder="Enter group name">
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
                            <input type="text" wire:model="multicast_address" class="form-control" placeholder="Enter multicast address">
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
                                    <a href="{{ route('profile-edit', ['id' => $item->id]) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm"
                                        wire:click.prevent="delete({{ $item->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
</div>
