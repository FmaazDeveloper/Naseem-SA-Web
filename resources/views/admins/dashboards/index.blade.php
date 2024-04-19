@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-3 mx-auto justify-content-center m-auto text-center">
                <div class="col m-1 p-1 shadow bg-light">

                    <div class="col row-cols-md-4 m-3 p-1 rounded text-center">

                        <a href="{{ route('roles.index') }}">
                            <div class="card text-bg-primary m-3">
                                <div class="card-header">Managing roles</div>
                                <div class="card-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                        class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                        <path
                                            d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('permissions.index') }}">
                            <div class="card text-bg-info m-3">
                                <div class="card-header">Managing permissions</div>
                                <div class="card-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                        fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                        <path
                                            d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('users.index') }}">
                            <div class="card text-bg-warning m-3">
                                <div class="card-header">Managing users</div>
                                <div class="card-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                        fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('administrative_regions.index') }}">
                            <div class="card text-bg-secondary m-3">
                                <div class="card-header">Managing content</div>
                                <div class="card-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                        fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                        <path
                                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                        <path
                                            d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                    </svg>
                                </div>
                            </div>
                        </a>

                    </div>

                </div>
            </div>
            <div class="col-md-9 shadow bg-light">
                <div class="col">
                    {{-- Permissions --}}
                    <div class="card text-bg-info m-3">

                        <div class="card-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                <path
                                    d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                            </svg>
                            Permissions
                            <span class="float-end fs-5">{{ $permissions->count() }}</span>
                        </div>

                        <div class="card-body row row-cols-md-4 text-center">

                            @foreach ($permissions as $permission)
                                <div class="container">
                                    <div class="col m-1 shadow p-1 bg-body-secondary rounded">

                                        <div class="card text-bg-info m-1">
                                            <div class="card-header">
                                                <h6>
                                                    {{ $permission->name }}
                                            </div>
                                            <div class="card-body">
                                                <span class="fs-4">
                                                    {{ $usersPermissions[$permission->id] }}
                                                </span>
                                            </div>
                                            </h6>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col">
                        {{-- Users --}}
                        <div class="card text-bg-warning m-3">

                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                                Users
                                <span class="float-end fs-5">{{ $users->count() }}</span>
                            </div>

                            <div class="card-body col">

                                @foreach ($roles as $role)
                                    <div class="container">
                                        <div class="col m-1 shadow p-1 bg-body-secondary rounded">

                                            <div class="card text-bg-warning m-1">
                                                <div class="card-header text-center">
                                                    <h6 class="text-capitalize">
                                                        {{ $role->name }}
                                                </div>
                                                <div class="card-body">
                                                    <ul>
                                                        <li>
                                                            Active :
                                                            <span class="float-end">
                                                                {{ $usersRolesActive[$role->id] }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            Unactive :
                                                            <span class="float-end">
                                                                {{ $usersRolesUnactive[$role->id] }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                </h6>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        {{-- Roles --}}
                        <div class="card text-bg-primary m-3">

                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                                </svg>
                                Roles
                                <span class="float-end fs-5">{{ $roles->count() }}</span>
                            </div>

                            <div class="card-body row col text-center">

                                @foreach ($roles as $role)
                                    <div class="container">
                                        <div class="col m-1 shadow p-1 bg-body-secondary rounded">

                                            <div class="card text-bg-primary m-1">
                                                <div class="card-header">
                                                    <h6>
                                                        {{ $role->name }}
                                                </div>
                                                <div class="card-body">
                                                    <span class="fs-4">
                                                        {{ $usersRolesActive[$role->id] + $usersRolesUnactive[$role->id] }}
                                                    </span>
                                                </div>
                                                </h6>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <div class="col">
                        {{-- Contents --}}
                        <div class="card text-bg-secondary m-3">

                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                    <path
                                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                    <path
                                        d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                </svg>
                                Contents
                                <span class="float-end fs-5">{{ $contentCount }}</span>
                            </div>

                            <div class="card-body col">

                                <div class="container">
                                    <div class="col m-1 shadow p-1 bg-body-secondary rounded">
                                        <div class="card text-bg-secondary m-1">
                                            <div class="card-header text-center">
                                                <h6 class="text-capitalize">
                                                    Regions
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <li>
                                                        Active :
                                                        <span class="float-end">
                                                            {{ $regionsActive }}
                                                        </span>
                                                    </li>
                                                    <li>
                                                        Unactive :
                                                        <span class="float-end">
                                                            {{ $regionsUnactive }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="col m-1 shadow p-1 bg-body-secondary rounded">
                                        <div class="card text-bg-secondary m-1">
                                            <div class="card-header text-center">
                                                <h6 class="text-capitalize">
                                                    Landmarks
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <li>
                                                        Active :
                                                        <span class="float-end">
                                                            {{ $landmarksActive }}
                                                        </span>
                                                    </li>
                                                    <li>
                                                        Unactive :
                                                        <span class="float-end">
                                                            {{ $landmarksUnactive }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="col m-1 shadow p-1 bg-body-secondary rounded">
                                        <div class="card text-bg-secondary m-1">
                                            <div class="card-header text-center">
                                                <h6 class="text-capitalize">
                                                    Activities
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <li>
                                                        Active :
                                                        <span class="float-end">
                                                            {{ $activitiesActive }}
                                                        </span>
                                                    </li>
                                                    <li>
                                                        Unactive :
                                                        <span class="float-end">
                                                            {{ $activitiesUnactive }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
