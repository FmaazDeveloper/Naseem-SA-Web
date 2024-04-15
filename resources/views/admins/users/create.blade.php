@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>
                            Create User
                            <a href="{{ route('users.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">

                        <form method="post" action="{{ route('users.store') }}">

                                @csrf

                                <div class="mb-3">
                                    <select class="form-select" name="role">
                                        <option selected disabled>Select role</option>
                                        <ol>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </ol>
                                    </select>
                                    @error('role')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                    @error('name')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                                    @error('password')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm password</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    @error('password_confirmation')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input name="is_active" type="checkbox" value="1" class="form-check-input" id="is_active">
                                    <label class="form-check-label" for="is_active">Is active</label>
                                    @error('is_active')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success">Create</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
