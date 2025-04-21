<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inventory</h1>
                </div>
                @can('admin-create-device')
                    <div class="col-sm-6 text-right">
                        <button class="btn btn-success" wire:click="createInventory">
                            <i class="fas fa-plus"></i> Add Device
                        </button>
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
                    <h3 class="card-title">Add New Device</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveInventory">

                        <div class="form-group">
                            <label for="ip_address">IP Address</label>
                            <input type="text" wire:model="inventory.ip_address" class="form-control"
                                placeholder="Enter ip address">
                            @error('inventory.ip_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gateway">Gateway</label>
                            <input type="text" wire:model="inventory.gateway" class="form-control"
                                placeholder="Enter gateway">
                            @error('inventory.gateway')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Next</button>
                        <button type="button" class="btn btn-danger" wire:click="hideInventoryForm">
                            Cancel
                        </button>
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
                            <th style="width: 5%"scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Device name</th>
                            <th scope="col" class="text-center">Region</th>
                            <th scope="col" class="text-center">IP address</th>
                            <th scope="col" class="text-center">Group</th>
                            <th scope="col" class="text-center">Uptime</th>
                            <th scope="col" class="text-center">Status</th>
                            <th style="width: 12%" scope="col" class="text-center">Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data) && $data->isNotEmpty())
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->inventory_name }}</td>
                                    <td class="text-center">{{ $item->region }}</td>
                                    <td class="text-center">{{ $item->ip_address }}</td>
                                    <td class="text-center">{{ $item->group_name }}</td>
                                    <td class="text-center">{{ $item->uptime }}</td>
                                    <td class="text-center">{{ $item->device_status }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('profile-view', ['id' => $item->id]) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editInventoryModal"
                                            wire:click="editInventory({{ $item->id }})">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @can('admin-edit-menu')
                                            <button class="btn btn-danger btn-sm"
                                                wire:click.prevent="delete({{ $item->id }})">
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
                {{-- {{ $data->links('pagination::bootstrap-4') }} --}}
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="editInventoryModal" tabindex="-1" role="dialog"
        aria-labelledby="editInventoryModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInventoryModalLabel">Edit Device</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateInventory">
                        <div class="form-group">
                            <label for="inventory_name">Device Name</label>
                            <input type="text" wire:model="inventory.inventory_name" class="form-control"
                                placeholder="Enter device name">
                            @error('inventory.inventory_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="region">Region</label>
                            <select id="region" wire:model="inventory.region" class="form-control"
                                placeholder="Enter region">
                                <option value=""> Please Choose Region</option>
                                <option value="North">North</option>
                                <option value="East">East</option>
                                <option value="West">West</option>
                                <option value="South">South</option>
                            </select>
                            @error('inventory.region')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="connection_type">Connection Type</label>
                            <input type="text" wire:model="inventory.connection_type" class="form-control"
                                placeholder="Enter connection type">
                            @error('inventory.connection_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="port_info">Port Info</label>
                            <input type="text" wire:model="inventory.port_info" class="form-control"
                                placeholder="Enter port info">
                            @error('inventory.port_info')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city_location">City Location</label>
                            <input type="text" wire:model="inventory.city_location" class="form-control"
                                placeholder="Enter city location">
                            @error('inventory.city_location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="building_name">Building Name</label>
                            <input type="text" wire:model="inventory.building_name" class="form-control"
                                placeholder="Enter building name">
                            @error('inventory.building_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="floor">Floor</label>
                            <input type="text" wire:model="inventory.floor" class="form-control"
                                placeholder="Enter floor">
                            @error('inventory.floor')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="room_name">Room Name</label>
                            <input type="text" wire:model="inventory.room_name" class="form-control"
                                placeholder="Enter room name">
                            @error('inventory.room_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="installation_date">Installation Date</label>
                            <input type="date" wire:model="inventory.installation_date" class="form-control"
                                placeholder="Enter date">
                            @error('inventory.installation_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="asset_code">Asset Code</label>
                            <input type="text" wire:model="inventory.asset_code" class="form-control"
                                placeholder="Enter asset code">
                            @error('inventory.asset_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contractor_company">Contractor Company</label>
                            <input type="text" wire:model="inventory.contractor_company" class="form-control"
                                placeholder="Enter contractor company">
                            @error('inventory.contractor_company')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contractor_number">Contractor Number</label>
                            <input type="text" wire:model="inventory.contractor_number" class="form-control"
                                placeholder="Enter contractor number">
                            @error('inventory.contractor_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="warranty_expiration_date">Warranty Expiration Date</label>
                            <input type="date" wire:model="inventory.warranty_expiration_date"
                                class="form-control" placeholder="Enter warranty expiration date">
                            @error('inventory.warranty_expiration_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ip_address">IP Address</label>
                            <input type="text" wire:model="inventory.ip_address" class="form-control"
                                placeholder="Enter ip address">
                            @error('inventory.ip_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mac_address">Mac Address</label>
                            <input type="text" wire:model="inventory.mac_address" class="form-control"
                                placeholder="Enter mac address">
                            @error('inventory.mac_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gateway">Gateway</label>
                            <input type="text" wire:model="inventory.gateway" class="form-control"
                                placeholder="Enter gateway">
                            @error('inventory.gateway')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subnet_mask">Subnetmask</label>
                            <input type="text" wire:model="inventory.subnet_mask" class="form-control"
                                placeholder="Enter subnet mask">
                            @error('inventory.subnet_mask')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="hardware_serial_number">Hardware Serial Number</label>
                            <input type="text" wire:model="inventory.hardware_serial_number" class="form-control"
                                placeholder="Enter hardware serial number">
                            @error('inventory.hardware_serial_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="software_version">Software Version</label>
                            <input type="text" wire:model="inventory.software_version" class="form-control"
                                placeholder="Enter software version">
                            @error('inventory.software_version')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="device_status">Device Status</label>
                            <input type="text" wire:model="inventory.device_status" class="form-control"
                                placeholder="Enter device status">
                            @error('inventory.device_status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Add more fields as needed -->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('close-modal', event => {
        $('#editInventoryModal').modal('hide');
    });
</script>
