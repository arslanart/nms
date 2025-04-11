<div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Group</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-success" href="{{ route('group') }}">
                            <i class="fas fa-plus"></i> Add Group
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 10%">
                            No.
                        </th>
                        <th style="width: 20%">
                            Group Name
                        </th>
                        <th style="width: 30%">
                            Multicast Address
                        </th>
                        <th style="width: 8%">
                            Port
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                <a>
                                    {{ $item->group_name }}
                                </a>
                            </td>
                            <td>
                                {{ $item->multicast_address }}
                            </td>
                            <td class="project_progress">
                                {{ $item->port }}
                            </td>
                            {{-- <td class="project-state">
                                <span class="badge badge-success">Success</span>
                            </td> --}}

                            {{-- Action --}}
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('group-view', ['id' => $item->id]) }}">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{ route('group-edit', ['id' => $item->id]) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" wire:click="delete({{ $item->id }})"
                                    href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $data->links() }}
    </div>
</div>
