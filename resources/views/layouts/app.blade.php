<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/logo/icon-boolbnb.svg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BoolBnB</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome CDN -->
    <script src="https://kit.fontawesome.com/95701d90ff.js" crossorigin="anonymous"></script>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

    @yield('scripts')
</head>

<body>
    <div id="app">


        <header class="navbar navbar-expand navbar-light bg-white shadow-sm p-0">
            <div class="container flex-nowrap">
                <a class="navbar-brand d-flex align-items-center" href="http://localhost:5174/#/">
                    <img src="{{ asset('storage/logo/Logo.svg') }}" width="120" alt="">
                    {{-- config('app.name', 'Laravel') --}}
                </a>
                <a href="{{ route('dashboard') }}" class="navbar-brand fs-6">Dashboard</a>

                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
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
                                    <a class="dropdown-item" href="{{ url('/') }}">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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
        </header>

        <main class="">
            @yield('content')
        </main>
    </div>

</body>

</html>
