<!-- filepath: d:\laragon\www\NMS\resources\views\livewire\admin-menu.blade.php -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Group</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-success" wire:click="createGroup">
                        <i class="fas fa-plus"></i> Add Group
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped table-bordered">
                    <thead class="bg-dark-secondary text-dark">
                        <tr>
                            <th style="width: 10%"scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Group</th>
                            <th scope="col" class="text-center">Multicast address</th>
                            <th scope="col" class="text-center">Port</th>
                            <th style="width: 12%" scope="col" class="text-center">Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data) && $data->isNotEmpty())
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->group_name }}</td>
                                    <td class="text-center">{{$item->multicast_address }}</td>
                                    <td class="text-center">{{ $item->port}}</td>
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
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
</div>
