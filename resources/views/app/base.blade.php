<!doctype html>
<html style="min-height: 100vh;">
    <head>
        
        <meta charset="utf-8">
        <title>ForumPa</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<script src="https://code.jquery.com/jquery-1.10.2.min.js" defer></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js" defer></script>
        <link rel="stylesheet" href="{{ url('assets/base.css') }}">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.css" integrity="sha512-YfFXNd2o6swxA1M0ll6EDdnVdYdE6iz+C6k0Guqf18JW6sVq6Oz9lfbjOso+LMwwNYNxUbp7egkYmC2W/IyeVA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.css" integrity="sha512-03p8fFZpOREY+YEQKSxxretkFih/D3AVX5Uw16CAaJRg14x9WOF18ZGYUnEqIpIqjxxgLlKgIB2kKIjiOD6++w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    </head>
    <body style="min-height: 100vh;position: relative;">
        <nav class="navbar navbar-expand-lg navbar-dark p-3 bg-primary mb-5" id="headerNav">
            <div class="container-fluid">
                <a class="navbar-brand d-block d-lg-none" href="#">
                    <img src="/static_files/images/logos/logo_2_white.png" height="80" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mx-auto ">
                        <li class="nav-item">
                            <a class="nav-link mx-2 active" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand mr-3 ml-3 font-weight-bolder" href="{{ url('/') }}">ForumPa</a>
                        </li>
                        @if (session()->has('user'))
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="{{ url('login') }}">change account</a>
                            </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="{{ url('login') }}">Log In</a>
                        </li>
                        @endif
                    </ul>
                    @if (session()->has('user'))
                        <a class="text-white text-right position-absolute text-decoration-none font-weight-bold" style="right: 10px;" href="{{ url('user/' . session('user')->id) }}">{{ session('user')->name }}<img src="{{ session('user')->image }}" class="ml-3 rounded-circle" width="50" alt="User" />
                        </a>
                    @endif
                </div>
            </div>
        </nav>
        @yield('content')
        <!-- Copyright -->
        <div class="text-center p-3 bg-primary text-white mt-5 w-100" style="position:absolute;bottom:0;z-index:999;">
            © 2022 Copyright - 
            <a class="text-white" href="{{ url('/') }}">ForumPa.com</a>
        </div>
        <!-- Copyright -->
        @yield('modalContent')
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        @yield('scripts')
    </body>
    @yield('styles')
</html>