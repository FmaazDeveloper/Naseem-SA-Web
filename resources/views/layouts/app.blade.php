<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset(config('app.logo')) }}">
    <title>{{ config('app.name', 'Naseem-SA') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <!-- fixed-top bg-success p-2 text-dark bg-opacity-25 border border-dark rounded -->
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item pt-1 m-3">
                            <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                href="{{ route('contents.index') }}">
                                <img src="/images/navbar_icons/home.png" class="rounded" alt="regions" width="22"
                                    height="22" !important>
                                {{ __('Home Page') }}
                            </a>
                        </li>
                        <li class="nav-item pt-1 m-3">
                            <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                href="{{ route('contents.administrative_regions') }}">
                                <img src="/images/navbar_icons/administrative_regions.png" class="rounded" alt="regions"
                                    width="22" height="22" !important>
                                {{ __('Regions') }}
                            </a>
                        </li>
                        <li class="nav-item pt-1 m-3">
                            <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                href="{{ route('contents.regions') }}">
                                <img src="/images/navbar_icons/regions.png" class="rounded" alt="landmarks"
                                    width="22" height="22" !important>
                                {{ __('Cities/Islands') }}
                            </a>
                        </li>
                        <li class="nav-item pt-1 m-3">
                            <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                href="{{ route('contents.landmarks') }}">
                                <img src="/images/navbar_icons/landmarks.png" class="rounded" alt="landmarks"
                                    width="22" height="22" !important>
                                {{ __('Landmarks') }}
                            </a>
                        </li>
                        <li class="nav-item pt-1 m-3">
                            <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                href="{{ route('tickets.create') }}">
                                <img src="/images/navbar_icons/contact_us.png" class="rounded" alt="contact_us"
                                    width="22" height="22" !important>
                                {{ __('Contact Us') }}
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item"
                                        href="{{ Auth::user()->hasRole('manager|super-admin|admin') ? route('dashboards.index') : route('profiles.index', Auth::user()->id) }}">
                                        {{ Auth::user()->hasRole('manager|super-admin|admin') ? __('Dashboard') : __('Profile') }}
                                    </a>

                                    @if (Auth::user()->hasRole('tourist'))
                                        <a class="dropdown-item" href="{{ route('request_orders.index') }}">
                                            {{ __('Order guide') }} </a>
                                    @elseif(Auth::user()->hasRole('guide'))
                                        <a class="dropdown-item" href="{{ route('request_orders.show') }}">
                                            {{ __('View orders') }} </a>
                                    @endif

                                    <hr class="dropdown-divider">

                                    <a class="dropdown-item text-body-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="min-vh-100">
            @yield('content')
        </main>


        <div class="card text-center">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title">Contact Us</h5>
                        <p class="card-text">Phone number: <a href="https://wa.me/+966123456789" target="_blanck">+966 12 345 6789</a></p>
                        <p class="card-text">Email address: <a href="mailto:FmaazDeveloper@gmail.com" target="_blanck">FmaazDeveloper@gmail.com</a></p>
                    </div>
                    <div class="col-4">
                        <h5 class="card-title">Links</h5>
                        <p><a href="{{ route('contents.index') }}">Home</a></p>
                        <p><a href="{{ route('contents.regions') }}">Regions</a></p>
                        <p><a href="{{ route('tickets.create') }}">Contact Us</a></p>
                    </div>
                    <div class="col-4">
                        <div class="footer-social">
                            <h5 class="card-title">Follow Us</h5>
                                <a href="https://web.snapchat.com/" target="_blanck"><img src="images/footer_icons/snapchat.png" width="50" height="50" alt="Snapchat"></a>
                                <a href="https://www.instagram.com/" target="_blanck"><img src="images/footer_icons/instagram.png" width="40" height="40" alt="Instagram"></a>
                                <a href="https://twitter.com/home" target="_blanck"><img src="images/footer_icons/x.png" width="40" height="40" alt="X"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-body-secondary">
                <footer class="position-relative">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-muted">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    </div>
</body>

</html>
