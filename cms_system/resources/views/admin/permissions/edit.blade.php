<x-admin-master>
    @section('content')

        <h1>Edit Role: {{ $permission->name }}</h1>
        @if(session('permission-update'))
            <div class="alert alert-success">{{session('permission-update')}}</div>
        @endif

        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{ route('permission.update', $permission->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{ $permission->name }}"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary btn-group">Update</button>
                </form>

            </div>
        </div>

    @endsection
</x-admin-master>
