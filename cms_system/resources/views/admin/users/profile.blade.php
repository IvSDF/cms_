<x-admin-master>
    @section('content')

        <h1>User Profile for: {{$user->name}}</h1>

        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{ route('user.profile.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="m-4">
                        <img width="150px" class="img-profile rounded-circle" src="{{ $user->avatar }}">
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control
                               @error('username')
                                    is-invalid
                               @enderror"
                               id="username"
                               value="{{$user->username}}">

                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               id="name"
                               value="{{$user->name}}">

                        @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text"
                               name="email"
                               class="form-control"
                               id="email"
                               value="{{$user->email}}">

                        @error('email')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               id="password">

                        @error('password')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">Confirm Password</label>
                        <input type="password"
                               name="password-confirmation"
                               class="form-control"
                               id="password-confirmation">

                        @error('password_confirmation')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div >
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                @if(auth()->user()->userHasRole('Admin'))
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
                                        @foreach($roles as $role)
                                            <tr>
                                                <th><input type="checkbox"
                                                           @foreach($user->roles as $user_role)
                                                               @if($user_role->slug == $role->slug)
                                                                   checked
                                                        @endif
                                                        @endforeach
                                                    ></th>
                                                <th>{{ $role->id }}</th>
                                                <th>{{ $role->name }}</th>
                                                <th>{{ $role->slug }}</th>
                                                <th>
                                                    <form action="{{ route('user.role.attach', $user) }}" method="post">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="hidden" name="role" value="{{ $role->id }}">
                                                        <button
                                                            type="submit"
                                                            class="btn badge-primary"
                                                            @if($user->roles->contains($role))
                                                                disabled
                                                            @endif
                                                        >
                                                            Attach
                                                        </button>
                                                    </form>
                                                </th>
                                                <th>
                                                    <form action="{{ route('user.role.detach', $user) }}" method="post">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="hidden" name="role" value="{{ $role->id }}">
                                                        <button type="submit"
                                                                class="btn badge-danger"
                                                                @if(!$user->roles->contains($role))
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
                @endif
            </div>
        </div>

    @endsection
</x-admin-master>
