<x-admin-master>
    @section('content')

        <h1>Edit Role: {{ $role->name }}</h1>
        @if(session('role-update'))
            <div class="alert alert-success">{{session('role-update')}}</div>
        @endif

        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{ route('role.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{ $role->name }}"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary btn-group">Update</button>
                </form>
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableUsers" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Roles</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Roles</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <th><input type="checkbox"
                                                   @foreach($role->permissions as $role_permission)
                                                       @if($role_permission->slug == $permission->slug)
                                                           checked
                                                @endif
                                                @endforeach
                                            ></th>
                                        <th>{{ $permission->id }}</th>
                                        <th>{{ $permission->name }}</th>
                                        <th>{{ $permission->slug }}</th>
                                        <th>
                                            <form action="{{ route('role.permission.attach', $role) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="permission" value="{{ $permission->id }}">
                                                <button
                                                    type="submit"
                                                    class="btn badge-primary"
                                                    @if($role->permissions->contains($permission))
                                                        disabled
                                                    @endif
                                                >
                                                    Attach
                                                </button>
                                            </form>
                                        </th>
                                        <th>
                                            <form action="{{ route('role.permission.detach', $role) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="permission" value="{{ $permission->id }}">
                                                <button type="submit"
                                                        class="btn badge-danger"
                                                        @if(!$role->permissions->contains($permission))
                                                            disabled
                                                        @endif
                                                >
                                                    Detach
                                                </button>
                                            </form>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
</x-admin-master>
