<div>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f7fa;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 6px;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        p {
            color: #333333;
        }

        h1 {
            margin-top: 0;
            font-size: 24px;
            font-weight: bold;
        }

        h2 {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }

        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 20px;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        .pb-4 {
            padding-bottom: 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            display: block;
            max-width: 50px;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 18px;
            font-weight: bold;
        }
    </style>

    <div class="container">
        <div class="logo-container">
            <img src="{{ asset(config('app.logo')) }}" alt="App Logo" class="logo">
            <span class="logo-text">{{ config('app.name') }}</span>
        </div>
        <h1 class="mt-4 mb-4">Dear {{ $data['name'] }},</h1>

        <main>
            @yield('message')
        </main>

        {{-- <div>
            <a href="{{ $url }}" class="btn btn-primary">@yield('button-home')</a>
        </div> --}}
        <p>
            <b>Best regards,<br>
                {{ config('app.name') }} Team</b>
        </p>
    </div>
</div>
