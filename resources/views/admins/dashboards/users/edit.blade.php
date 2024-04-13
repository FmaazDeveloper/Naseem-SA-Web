@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
        <div class="row col-6 m-5 p-3 mb-3 bg-light shadow rounded">

            @csrf
            @method('PUT')
            <div class="mb-3">
                <select class="form-select" name="permissions[]" multiple>
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}" @selected($user->hasPermissionTo($permission->name))>{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ $user->name }}" required autocomplete="name" autofocus>
                @error('name')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ $user->email }}" required autocomplete="email">
                @error('email')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" value="{{ $user->password }}" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">
                @error('password')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm password</label>
                <input id="password_confirmation" value="{{ $user->password }}" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
                @error('password_confirmation')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input name="is_active" type="checkbox" value="1" class="form-check-input" id="is_active">
                <label class="form-check-label" for="is_active">Is active</label>
            </div>

            <button type="submit" class="btn btn-success">Update</button>

        </div>
    </form>
@endsection
