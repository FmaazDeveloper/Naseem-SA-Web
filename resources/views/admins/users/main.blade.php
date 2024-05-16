@extends('layouts.dashboard')

@section('contents')
    <div class="row border rounded-3 bg-light m-5">
        <div class="col">
            <div class="row text-dark text-center m-2 border-dark border-bottom">
                <div class="card-header">
                    <h4>
                        Users
                        <span class="float-end fs-5">{{ $all_users->count() }}</span>
                    </h4>
                </div>
            </div>
            <div class="card-body row row-cols-md-5">
                @foreach ($roles as $role)
                    <div class="row">
                        <div class="col m-3">
                            <div class="card shadow text-bg-light m-1">
                                <div class="card-header text-capitalize text-center">
                                    <h6>{{ $role->name }}</h6>
                                </div>
                                <div class="card-body">
                                    <h6>
                                        <ul>
                                            <li class="text-success">
                                                Active :
                                                <span class="float-end">
                                                    {{ $usersRolesActive[$role->id] }}
                                                </span>
                                            </li>
                                            <li class="text-danger">
                                                Unactive :
                                                <span class="float-end">
                                                    {{ $usersRolesUnactive[$role->id] }}
                                                </span>
                                            </li>
                                        </ul>
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
            <h3>Managing Users</h3>
        </div>
    </div>
    <div class="row">
        @yield('form')
    </div>
@endsection
