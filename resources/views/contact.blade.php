@extends('layouts.app')


@section('title', 'contact')
@section('content')
	@php
			$contact = DB::table('users')->where('username', 'boss')->first();
			if($contact == []){
				$temp = DB::table('staff')->where('role', 'ADMIN')->first();
				$contact = DB::table('users')->where('username', $temp->username)->first();
			}
		@endphp
	<div class="content col-sm-10 col-sm-offset-2">
		<h1 style="text-align: center;"><b>Contact</b><h1>
		<b class="col-sm-2">Address:</b> <p class="col-sm-4">{{$contact->address }}<br>{{ $contact->post_code}}<p>
		<b class="col-sm-2">Tel No:</b> <p class="col-sm-4">{{$contact->phone_no}}</p>
		<p><b class="col-sm-2">email:</b><p class="col-sm-4">{{$contact->email}}<p><br>
		
		@if(Auth::check())
			@if(Auth::user()->type=='STAFF')
				@if($error = Session::get('errors'))
				<div class="col-sm-12 alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                	<li>{{ $error }}</li>
                </ul>
            </div>
			@elseif (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
			<button class="btn" href="#" style="font-size: 90%;" id="edit"
                   onclick="$('#edit_details').slideToggle(function(){
                   	$('#edit').html($('#edit_details').is(':visible')?'Leave Details':'Edit Details');});">Edit Details</button>
			<div id="edit_details" style="display: none;">
			<form class="col-sm-12" 
			action="{{ route('info.update.post', 'address') }}" method="POST" enctype="multipart/form-data">
			@csrf
				Edit Address:<br> <input type="text" class="form-control" name="address" required/><br>
				Post Code:<br> <input type="text" class="form-control" name="post_code" required/>
				<button class="btn">Submit</button><br>
			</form>
			<form class="col-sm-12" 
			action="{{ route('info.update.post', 'phone_no') }}" method="POST" enctype="multipart/form-data">
			@csrf
				Edit Phone Number: <br><input type="text" class="form-control" name="phone_no" required/>
				<button class="btn">Submit</button><br>
			</form>
			<form class="col-sm-12" 
			action="{{ route('info.update.post', 'email') }}" method="POST" enctype="multipart/form-data">
			@csrf 
				Edit Email: <br><input type="text" class="form-control" name="email" required/>
				<button class="btn">Submit</button>
			</form>
			</div>
			@endif
		@endif
	</div>
@endsection