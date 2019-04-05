<html>
    <head>
    	<!--Add bootstrap -->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    	<link href="{{ asset('../resources/css/general-style.css') }}" rel="stylesheet">
		@yield('stylesheets')
      <title>Aston Animal Sanctuary - @yield('title')</title>
    </head>
    <body>
		  <div id="header">
			<h1>Aston Animal Sanctuary</h1>		  
		  </div> 
		     	
        
        		<div class="col-sm-2" id="sidebar">
					<ul>
						@section('sidebar')
						<li><a href='{!! url('/home'); !!}'>Home</a></li>
						<li><a href='{!! url('/about'); !!}'>About</a></li>		
						<li><a href='{!! url('/animals'); !!}'>Animals</a></li>
						<li><a href='{!! url('/staff'); !!}'>Staff</a></li>
						<li><a href='{!! url('/contact'); !!}'>Contact</a></li>
						@show			
					</ul>        		
        		</div>
        

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>