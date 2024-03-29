<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Aston Animal Sanctuary') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Angkor' rel='stylesheet'>
	
	<!--Add bootstrap -->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    	<link href="{{ asset('../resources/css/general-style.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('../resources/css/general-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheets')
</head>
<body>
    <div id="app">
		<div id="nav-bar" class="nav-menu col-sm-2">
      	
			<div id="nav-content">
				@section('sidebar')
					<a href='{!! url('/home'); !!}'>Home</a>
					<a href='{!! url('/about'); !!}'>About</a>
							<!--Check if user is staff and if so allow them to view records option on nav-menu-->
					@if(Auth::check())
						@if (Auth::user()->type == 'STAFF')			
							<a href='{!! url('/animals'); !!}'>View All Animals</a>
							<a href='{!! url('/viewRecords'); !!}'>View Adoption Records</a>
							<a href='{!! url('/newRecord'); !!}'>New Record</a>
						@else		
							<a href='{!! url('/animals'); !!}'>Adopt</a>
						@endif
					@else		
						<a href='{!! url('/animals'); !!}'>View All Animals</a>
					@endif
					<a href='{!! url('/staff'); !!}'>Staff</a>
					<a href='{!! url('/contact'); !!}'>Contact</a>
					
					<a class="btn" id="back-button" href="{{ URL::previous() }}">Back</a>
				@show			
			</div>                
       </div>      
       <nav class="col-sm-10 navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('Aston Animal Sanctuary', 'Aston Animal Sanctuary') }}
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
                                        {{ __('Logout') }}
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
        
        <main class="py-4 col-sm-offset-1 col-sm-10">
            @yield('content')
        </main>
    </div>
    <div id="footer" class="col-sm-12">
    	
    </div>
</body>

@yield('scripts')
</html>
