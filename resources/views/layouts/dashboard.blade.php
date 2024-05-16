@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="d-flex col-2">
            <main class="d-flex min-vh-100">
                <h1 class="visually-hidden">Sidebars examples</h1>

                <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark rounded-end" style="width: 280px;">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="{{ asset(config('app.logo')) }}" alt="{{ config('app.name', 'Naseem-SA') }}" width="40"
                            height="40">
                        <span class="fs-4">{{ config('app.name', 'Naseem-SA') }}</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="{{ route('dashboards.index') }}" class="nav-link text-white" onclick="handleClick(event)"
                                id="link0">
                                <img src="{{ asset('images/dashboard_icons/dashboard.png') }}" alt="Dashbord" width="20" height="20" style="filter: invert(100%);">
                                Dashbord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link text-white" onclick="handleClick(event)"
                                id="link1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                                </svg>
                                Roles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('permissions.index') }}" class="nav-link text-white" onclick="handleClick(event)"
                                id="link2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                                </svg>
                                Permissions
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}" class="nav-link text-white" onclick="handleClick(event)"
                                id="link3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                                Users
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('administrative_regions.index') }}" class="nav-link text-white"
                                onclick="handleClick(event)" id="link4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-card-text" viewBox="0 0 16 16">
                                    <path
                                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                    <path
                                        d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                </svg>
                                Contents
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('orders.index') }}" class="nav-link text-white" onclick="handleClick(event)"
                                id="link5">
                                <img src="{{ asset('images/dashboard_icons/orders.png') }}" alt="Dashbord" width="20" height="20">
                                Orders
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tickets.index') }}" class="nav-link text-white" onclick="handleClick(event)"
                                id="link6">
                                <img src="{{ asset('images/dashboard_icons/tickets.png') }}" alt="Dashbord" width="20" height="20" style="filter: invert(100%);">
                                Tickets
                            </a>
                        </li>
                    </ul>
                </div>
            </main>
        </div>

        {{-- <div class="b-example-divider b-example-vr"></div> --}}

        <div class="col-10">
            @yield('contents')
        </div>
    </div>

    <script>
        // Function to handle the click event
        function handleClick(event) {
            // Remove the "active" class from all links
            var links = document.querySelectorAll('.nav-link');
            links.forEach(function(link) {
                link.classList.remove('active');
            });

            // Add the "active" class to the clicked link
            event.target.classList.add('active');

            // Store the id of the active link in localStorage
            var activeLinkId = event.target.id;
            localStorage.setItem('activeLinkId', activeLinkId);
        }

        // Get the id of the active link from localStorage
        var activeLinkId = localStorage.getItem('activeLinkId');
        if (activeLinkId) {
            // Add the "active" class to the link with the stored id
            var activeLink = document.getElementById(activeLinkId);
            activeLink.classList.add('active');
        }
    </script>
@endsection
