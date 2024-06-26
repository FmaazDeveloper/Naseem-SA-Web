@extends('admins.permissions.main')

@section('form')
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>
                            Create Permission
                            <a href="{{ route('permissions.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body m-3">

                        <form method="post" action="{{ route('permissions.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Permission Name</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Add</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
