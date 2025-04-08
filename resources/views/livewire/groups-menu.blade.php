<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0 text-center">เพิ่มข้อมูล Group</h4>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- แสดงข้อความแจ้งเตือนสำเร็จ -->
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- แสดงข้อความแจ้งเตือนข้อผิดพลาด -->
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Main content -->
        <section class="content">
            <!-- ฟอร์มสำหรับกรอกข้อมูล -->
            <form wire:submit.prevent="saveGroup">
                <div class="mb-3">
                    <label for="group_name" class="form-label">Group Name</label>
                    <input type="text" id="group_name" class="form-control" wire:model="group_name">
                    @error('group_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="port" class="form-label">Port</label>
                    <input type="text" id="port" class="form-control" wire:model="port">
                    @error('port') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="multicast_address" class="form-label">Multicast Address</label>
                    <input type="text" id="multicast_address" class="form-control" wire:model="multicast_address">
                    @error('multicast_address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </section>
        <!-- /.content -->
    </div>
</div>
