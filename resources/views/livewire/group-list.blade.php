<div>
    <div class="content-wrapper">
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            No.
                        </th>
                        <th style="width: 2%">
                            Group Name
                        </th>
                        <th style="width: 8%" >
                            Multicast Address
                        </th>
                        <th style="width: 8%" >
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
                            {{-- <td class="project-actions text-right">
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
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $data->links() }}
    </div>
</div>
