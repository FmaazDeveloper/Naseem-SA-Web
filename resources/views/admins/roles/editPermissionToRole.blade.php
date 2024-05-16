@extends('admins.roles.main')

@section('form')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    @if (session('msg'))
                        <div class="text-center alert alert-success">{{ session('msg') }}</div>
                    @endif
                    <div class="card-header">
                        <h4>
                            Role : {{ $role->name }}
                            <a href="{{ route('roles.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">

                        <form method="post" action="{{ route('roles.updatePermissionToRole', $role->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-3">
                                        <label for="{{ $permission->name }}"
                                            class="form-label">{{ $permission->name }}</label>
                                        <input id="{{ $permission->name }}" type="checkbox" name="permission[]"
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                        @error('permission')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
