@extends('layouts.dashboard')

@section('contents')
    <div class="row border rounded-3 bg-light m-5">
        <div class="col">
            <div class="row text-dark text-center m-2 border-dark border-bottom">
                <div class="card-header">
                    <h4>
                        Permissions
                        <span class="float-end fs-5">{{ $all_permissions->count() }}</span>
                    </h4>
                </div>
            </div>

            <div class="card-body row row-cols-md-4 text-center">
                @foreach ($all_permissions as $permission)
                    <div class="row">
                        <div class="col m-3">
                            <div class="card shadow text-bg-light m-1">
                                <div class="card-header">
                                    <h6>
                                        {{ $permission->name }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <h6>
                                        <span class="fs-4">
                                            {{ $usersPermissions[$permission->id] }}
                                        </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row bg-primary text-white rounded-3 text-center">
            <h3>Managing Permissions</h3>
        </div>
    </div>
    <div class="row">
        @yield('form')
    </div>
@endsection
