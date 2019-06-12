<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
	<?php
	/*
    <script src="{{ asset('js/app.js') }}" defer></script>
	*/
	?>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">	
	
	<!-- Appel de jQuery, bootstrap, et vue -->
	
	<?php
	/*
	<script src="{{ asset('js/app.js') }}"></script>	
	*/
	?>
	<script src="{{ asset('js/jquery.min.js') }}" ></script>
	<script src="{{ asset('js/bootstrap.min.js') }}" ></script>
	<script src="{{ asset('js/jquery-ui.js') }}" ></script>
	<script src="{{ asset('js/jquery.ui.datepicker-fr.js') }}" ></script>
	<script src="{{ asset('js/jquery.dataTables.min.js') }}" ></script>
	<!-- you load jquery somewhere above here ... -->
	<!--[if lt IE 9]>
	<script type="text/javascript" src="libs/flashcanvas.js"></script>
	<![endif]-->
	<script src="/js/jSignature.min.js"></script>
	
	
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
	
	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/responsive.css" rel="stylesheet">
	<link href="/css/menu.css" rel="stylesheet">
	<link href="/css/animate.min.css" rel="stylesheet">
	<link href="/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
	<link href="/css/skins/square/grey.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="/css/custom.css" rel="stylesheet">

	<script src="/js/modernizr.js"></script>
	<!-- Modernizr -->
	
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
		
			<div class="container">
				@if(session()->has('ok'))
					<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
				@endif
			
				@if(session()->has('error'))
					<div class="alert alert-danger  alert-dismissible"><?php echo  session('error');?></div>
				@endif			
			</div>
            @yield('content')
        </main>
    </div>
	
	<!-- Common script -->
	<script src="/js/common_scripts_min.js"></script>
	<!-- Wizard script -->
	<script src="/js/registration_wizard_func.js"></script>

</body>
</html>
