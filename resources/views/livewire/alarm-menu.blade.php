<!-- filepath: d:\laragon\www\NMS\resources\views\livewire\admin-menu.blade.php -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Alarm</h1>
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
                            <th scope="col" class="text-center">Device name</th>
                            <th scope="col" class="text-center">IP address</th>
                            <th scope="col" class="text-center">Type</th>
                            <th scope="col" class="text-center">Alarm duration</th>
                            <th scope="col" class="text-center">Alarm serverity</th>
                            <th scope="col" class="text-center">Description</th>
                            <th scope="col" class="text-center">Created date</th>
                            <th scope="col" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data) && $data->isNotEmpty())
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">{{ ucfirst($item->user_type) }}</td>
                                    <td>{{ $item->email }}</td>

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
