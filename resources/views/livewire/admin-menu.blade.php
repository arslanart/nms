<div class="content-wrapper">
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
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
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
                            <input type="text" id="name" wire:model="username" class="form-control" placeholder="Enter username">
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
                            <input type="text" id="email" wire:model="email" class="form-control" placeholder="Enter email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" wire:model="password" class="form-control" placeholder="Enter password">
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
                            <th style="width: 10%"scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Username</th>
                            <th scope="col" class="text-center">Level</th>
                            <th scope="col" class="text-center">Email</th>
                            <th style="width: 12%" scope="col" class="text-center">Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data) && $data->isNotEmpty())
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td class="text-center">{{ ucfirst($item->user_type) }}</td>
                                    <td>{{ $item->email }}</td>
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
