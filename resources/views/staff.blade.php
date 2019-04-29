<!--Information about te staff wit te option to edit information about yourself if you are staff-->
@extends('layouts.app') 
@section('title', 'contact')

@section('stylesheets')
	<script src="{{ asset('js/register.js') }}" defer></script>
@endsection

@section('content')
<div class="col-sm-offset-2 col-sm-10">
	<h1 style="text-align: center;">Staff</h1>
	<div>
	@foreach($staff as $staffMember)
		<div id="staff-display" class="col-md-6 content">
		@php $staff = $users->where('username', $staffMember->username)->first() @endphp
			<div class="col-sm-6" id="staff-info">
			<h1>{{$staff->name}}</h1><br/>
			<b>Role:</b> {{$staffMember->role}}<br/>
			<b>Email:</b> {{$staff->email}}
			<b>Phone-No:</b> {{$staff->phone_no}}
			</div>
			<div class="col-sm-6" id="staff-image">
				<img style="max-width: 200px; max-height: 190px;" src="{{$images->where('ref_type', 'STAFF')->where('ref_id', $staffMember->user_id)->first()->image_location}}" alt="">
			</div>
		</div>
	@endforeach

	</div>
</div>
@if(Auth::check())
	@if(Auth::user()->type=='STAFF')
	<div class="col-sm-12 line-break"></div>
	<div class="content col-sm-10 col-sm-offset-2">
		<h1 style="text-align: center;"><button id="addStaff" class="btn" onclick="$('#add-staff').slideToggle(function(){
                   	$('#addStaff').html($('#add-staff').is(':visible')?'Close':'Add Staff Member');});">Add Staff Member</button></h1>
      
      @if (count($errors) > 0)
         	<div class="alert alert-danger">
            	<strong>Whoops!</strong> There were some problems with your input.
               	<ul>
                    	@foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                  	@endforeach
              		</ul>
          		</div>
        	@endif
        	@if($message = Session::get('message'))
        		<div class="alert alert-success alert-block">
            	<button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        		</div>
        	@endif
      
      <div id="add-staff" class="col-sm-12" style="display: none;">
      	<form method="POST" action="{{ route('register.new.staff') }}">
      		@csrf
                        
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <select class="col-sm-5" name="title">
                                    <option>MISS</option>
                                    <option>MRS</option>
                                    <option>MS</option>
                                    <option>MR</option>
                                    <option>SIR</option>
                                    <option>DR</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" 
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="first_name" required>
                                
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Surname</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" 
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="surname" required>
                                
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                                
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Role</label>

                            <div class="col-md-6">
                                <select class="col-sm-5" name="role">
                                    <option>ADMIN</option>
                                    <option>ASSISTANT</option>
                                    <option>JANITOR</option>
                                    <option>MANAGER</option>
                                    <option>RECEPTIONIST</option>
                                    <option>VET</option>
                                    <option>VOLUNTEER</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-sm-right">Pay Scale</label>

                            <div class="col-md-6">
                                <select class="col-sm-5" name="pay_scale">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                        	<label class="col-sm-4 col-form-label text-sm-right">DOB:</label>
                        	<input type="date" name="dob" class="col-sm-3 form-control" required>
                        </div>
                        
								<div class="form-group row">
                        	<label class="col-sm-4 col-form-label text-sm-right">Start Date:</label>
                        	<input type="date" name="start" class="col-sm-3 form-control" required>
                        </div>

                        <div class="form-group row">
                        	<i class="col-sm-offset-4 col-sm-8" id="pswdLengthConfirmation"
                        	style="font-size: 80%; color: red; text-align: left;">
                        	Password must be 8 Characters Long</i>
                            	
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" style="height: 35px;" 
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                name="password" required onkeyup='checkPasswordLength(); checkPasswordsMatch()'>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                        <div class="registrationFormAlert col-sm-offset-4 col-sm-8" id="checkPasswordsMatch"></div>
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="passwordConfirm" style="height: 35px;" type="password" 
                                class="form-control" name="password_confirmation" required onkeyup="checkPasswordsMatch()">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" type="text" class="form-control" name="address" required></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="post_code" class="col-md-4 col-form-label text-md-right">{{ __('Post Code') }}</label>

                            <div class="col-md-6">
                                <input id="post_code" type="text" class="form-control" name="post_code" maxlength="10" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
									<div id="phoneNoCheck" class="col-sm-offset-4 col-sm-8"></div>
                            <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No') }}</label>
                            <div class="col-md-6">
                                <input id="phone_no" style="height: 35px;" type="tel" onkeyup="removeExcessWhiteSpace()" 
                                class="form-control" name="phone_no" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Register
                                </button>
                            </div>
                        </div>
      	</form>
      </div>
	</div>
	@endif
@endif
@endsection