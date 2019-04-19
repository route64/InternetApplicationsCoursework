<!--Information about te staff wit te option to edit information about yourself if you are staff-->
@extends('layouts.app') 
@section('title', 'contact')

@section('content')
<div class="col-sm-offset-2 col-sm-10">
	<h1 style="text-align: center;">Staff</h1>
	<div>
	@foreach($staff as $staffMember)
		<div id="staff-display" class="col-md-6">
			<div class="col-sm-6" id="staff-info">
			{{$users->where('username', $staffMember->username)->first()->name}}<br/>
			Role: {{$staffMember->role}}<br/>
			@if(Auth::check())
				@if (Auth::user()->type == 'STAFF')
					<button class="btn">Edit</button>
				@endif
			@endif
			</div>
			<div id="staff-image">
				<img style="max-width: 200px; max-height: 190px;" src="{{$images->where('ref_type', 'STAFF')->where('ref_id', $staffMember->user_id)->first()->image_location}}" alt="">
			</div>
		</div>
	@endforeach

	</div>
</div>
@endsection