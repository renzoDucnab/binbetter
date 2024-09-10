<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout=horizontal>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page }} | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/back/images/favicon/favicon.ico') }}" />

    <!-- Color modes -->
    <script src="{{ asset('assets/back/js/vendors/color-modes.js') }}"></script>

    <!-- Libs CSS -->
    <link href="{{ asset('assets/back/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/back/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/back/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/dataTables.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/responsive.dataTables.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/my-modified.css') }}">


</head>

<body>

    <div id="loading-container" class="d-none">
        <div id="loading-message">
            <img src="{{ asset('assets/back/images/loading/loading.gif') }}">
            <span id="loading-text mt-3" data-loading-text="Loading..."></span>
        </div>
    </div>

    <main id="main-wrapper" class="@auth main-wrapper @else container d-flex flex-column @endauth">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-none">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        @auth
        @if(Auth::user()->email_verified_at)
        @include('layouts.back.header')
        @include('layouts.back.navbar')
        @endif
        @endauth

        <div id="app-content">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('assets/back/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/back/js/swal2.js') }}"></script>
    <script src="{{ asset('assets/back/js/global.js') }}"></script>
    <script src="{{ asset('assets/back/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/back/libs/feather-icons/dist/feather.min.js') }}"></script>
    <script src="{{ asset('assets/back/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('assets/back/js/dataTables.js') }}"></script>
    <script src="{{ asset('assets/back/js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/back/js/responsive.dataTables.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/back/js/theme.min.js') }}"></script>

    <script src="{{ asset('assets/back/libs/jsvectormap/dist/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/back/libs/jsvectormap/dist/maps/world.js') }}"></script>
    <script src="{{ asset('assets/back/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/vendors/chart.js') }}"></script>

    <script src="{{ asset('assets/back/js/tinymce/tinymce.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            if (typeof tinymce !== 'undefined') {
                // Initialize TinyMCE for general textareas
                tinymce.init({
                    selector: 'textarea#description, textarea#re_description',
                    plugins: 'lists advlist', // Add advlist for advanced list options
                    toolbar: 'undo redo | formatselect | bold italic | bullist numlist outdent indent | alignleft aligncenter alignright alignjustify',
                    menubar: false
                });

                tinymce.init({
                    selector: 'textarea#subscription_description',
                    plugins: 'lists',
                    toolbar: 'bullist', 
                    menubar: false
                });
            } else {
                console.error('TinyMCE is not loaded');
            }
        });
    </script>


    @php
    $userProfile = Auth::check() ? Auth::user()->profile : '';
    $userUsername = Auth::check() ? Auth::user()->username : '';
    @endphp

    <script>
        const userProfile = '<?php echo $userProfile; ?>' || '<?php echo asset('assets/back/images/avatar/noprofile.webp ') ?>';
        const userUsername = '<?php echo $userUsername; ?>';

        $('#auth_user_username').text(userUsername);
        $('#auth_user_profile').attr('src', userProfile);
    </script>


    @stack('scripts')

</body>

</html>