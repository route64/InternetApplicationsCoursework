@extends('layouts.app')

@section('stylesheets')
<link href="{{ asset('../resources/css/general-style.css') }}" rel="stylesheet">
@endsection

@section('content')
@if(Auth::check())


@if ($errors->any())
    <div class="alert alert-danger col-sm-offset-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($error = Session::get('error'))
	<div class="alert alert-success alert-block col-sm-offset-2">
   	<button type="button" class="close" data-dismiss="alert">×</button>
      <strong style="color: red;">{{ $error }}</strong>
   </div>
@elseif ($message = Session::get('success'))
	<div class="alert alert-success alert-block col-sm-offset-2">
   	<button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
   </div>
 @endif
 	<div class="content col-sm-9 col-sm-offset-2">
		<div class="row">
			@if(Auth::check())
				@if(Auth::user()->type == 'STAFF')
					@php
					$profile_picture = DB::table('images')->where('ref_type', 'STAFF')->where('ref_id', Auth::user()->id)->first();
					@endphp
				@else
					@php
					$profile_picture = DB::table('images')->where('ref_type', 'USER')->where('ref_id', Auth::user()->id)->first();
					@endphp
				@endif
			@endif
			@if($profile_picture)
				<img class="col-sm-offset-3" style="width: 150px; height: 100px;" src="{{$profile_picture->image_location}}" alt="Image by Karen Arnold from Pixabay">
			@else
				<img class="col-sm-offset-3" style="width: 150px; height: 100px;" src="../resources/images/People/cartoon-dog.jpg" alt="Image by Karen Arnold from Pixabay">
			@endif
			<form class="col-sm-6" action="{{ route('user.info.post', Auth::user()->username) }}" method="POST" enctype="multipart/form-data">
				@csrf
				<b class="col-sm-2">New Image</b> 
				<input type="file" id="new_profile_pic" style="height: 30px;" name="new_profile_pic" class="col-sm-2 form-control">
				<div class="col-sm-12"><button class="btn col-sm-4 col-sm-offset-2" name="update_image">update</button></div>
			</form>
		</div>
		
		<form action="{{ route('user.info.post', Auth::user()->username) }}" method="POST" enctype="multipart/form-data">
		@csrf
			<div class="form-group row">
      		<label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

         	<div class="col-md-1">
         	 @php $title = Auth::user()->title @endphp
         		<select name="title">
            		<option value="MISS" @if($title=='MISS') selected="true"@endif>MISS</option>
               	<option value="MRS" @if($title=='MRS') selected="true"@endif>MRS</option>
               	<option value="MS" @if($title=='MS') selected="true"@endif>MS</option>
               	<option value="MR" @if($title=='MR') selected="true"@endif>MR</option>
               	<option value="SIR" @if($title=='SIR') selected="true"@endif>SIR</option>
               	<option value="DR" @if($title=='DR') selected="true"@endif>DR</option>
           		</select>
         	</div>
			</div>

     		<div class="form-group row">
     			<label for="name" class="col-md-4 col-form-label text-md-right">Name: </label> 
      		<i class="col-sm-2">{{ Auth::user()->name }}</i>
				
					<div class="col-md-3" id="name" style="display: none;" >
            		<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"  autofocus>
					</div>
				
					<a href="#" class="col-sm-offset-2 col-sm-1 btn" style="max-height:40px; font-size: 90%;" id="editName"
                   onclick="$('#name').slideToggle(function(){
                   	$('#editName').html($('#name').is(':visible')?'X':'Edit');});">
                   	Edit
            	</a>
			</div>
      	<div class="form-group row">
      		<label for="username" class="col-md-4 col-form-label text-md-right">Username: </label> 
      		<i class="col-sm-2">{{Auth::user()->username}}</i>
					<div class="col-md-3" id="username" style="display: none;" >
            		<input type="text" class="form-control" name="username" >
            	</div>
           	 	<a href="#" class="col-sm-offset-2 col-sm-1 btn" style="font-size: 90%;" id="editUsername"
                   onclick="$('#username').slideToggle(function(){
                   	$('#editUsername').html($('#username').is(':visible')?'X':'Edit');});">
                   	Edit
            	</a>
			</div>
			<div class="form-group row">
      		<label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label> 
      		<i class="col-sm-3">{{Auth::user()->email}}</i>
				<div class="col-md-3" id="email" style="display: none;" >
         		<input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >
					@if ($errors->has('email'))
            	<span class="invalid-feedback" role="alert">
               	<strong>{{ $errors->first('email') }}</strong>
               	</span>
            	@endif
         	</div>
         	<a href="#" class="col-sm-offset-1 col-sm-1 btn" style="font-size: 90%;" id="editEmail"
                   onclick="$('#email').slideToggle(function(){
                   	$('#editEmail').html($('#email').is(':visible')?'X':'Edit');});">
              	Edit
         	</a>
      	</div>
      
      <div class="form-group row">
      	<label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label> 
      	<i class="col-sm-2">{{Auth::user()->address}}</i>
      	
			<div class="col-md-3" id="address"  style="display: none;">
         	<input type="text" class="form-control" name="address" value="">
         </div>
         <a href="#" class="col-sm-offset-2 col-sm-1 btn" style="max-height:40px; font-size: 90%;" id="editAddress"
                   onclick="$('#address').slideToggle(function(){
                   	$('#editAddress').html($('#address').is(':visible')?'X':'Edit');});">
              	Edit
      	</a>
      </div>
                        
      <div class="form-group row">
      	<label for="post_code" class="col-md-4 col-form-label text-md-right">Post Code</label> 
      	<i class="col-sm-2">{{Auth::user()->post_code}}</i>
			
			<div class="col-md-3" id="postCode" style="display: none;">
         	<input type="text" class="form-control" name="post_code" maxlength="10">
         </div>
         <a href="#" class="col-sm-offset-2 col-sm-1 btn" style="font-size: 90%;" id="editPostCode"
                   onclick="$('#postCode').slideToggle(function(){
                   	$('#editPostCode').html($('#postCode').is(':visible')?'X':'Edit');});">
              	Edit
      	</a>
      </div>
                        
      <div class="form-group row">
      	<label for="phone_no" class="col-md-4 col-form-label text-md-right">Phone No</label>
      	<i class="col-sm-2"> {{Auth::user()->phone_no}}</i>
			<div class="col-md-3" id="phone_no" style="display: none;">
         	<input type="tel" class="form-control" name="phone_no">
         </div>
         <a href="#" class="col-sm-offset-2 col-sm-1 btn" style="font-size: 90%;" id="editPhoneNo"
                   onclick="$('#phone_no').slideToggle(function(){
                   	$('#editPhoneNo').html($('#phone_no').is(':visible')?'X':'Edit');});">
              	Edit
      	</a>
      </div>
      
      <div class="form-group row">
      	<a href="#" class="col-sm-offset-4 col-sm-2 btn" style="max-height:40px; font-size: 90%;" id="editPswd"
                   onclick="$('#changePswd').slideToggle(function(){
                   	$('#editPswd').html($('#changePswd').is(':visible')?'X':'Change Password');});">
              	Change Password
      	</a>
      	
      	<div id="changePswd" class="col-sm-offset-2" style="display: none;">
				<div class="form-group row col-sm-12">
      			<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
					<div class="col-md-6">
         			<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
						@if ($errors->has('password'))
               		<span class="invalid-feedback" role="alert">
                  		<strong>{{ $errors->first('password') }}</strong>
                  	</span>
               	@endif
       			</div>
     			</div>
				<div class="form-group row col-sm-12">
      			<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
					<div class="col-md-6">
            		<input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            	</div>
      		</div>
      	</div>
      </div>

      <div class="form-group row mb-0 col-sm-12">
         <button class="col-sm-offset-4 btn" type="submit" name="save">Save</button>
     	</div>
		</form>
	</div>	
@endif
@endsection