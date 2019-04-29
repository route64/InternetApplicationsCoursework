@extends('layouts.app')

@section('content')
	<div class="col-sm-offset-2 col-sm-4">
		<h1 id="animal-name">{{$animal->name}}</h1>
		<p id="animal-dob"><b>DOB:</b> {{$animal->DOB}}</p><br/>
		<p id="animal-desc"><b>Description:</b> {{$animal->description}}</p><br/>
		<b>@php if($animal->adopted == 0){ $adopted=0; print "Not Adopted";} 
		else { $adopted = 1; Print "I'm Adopted";} @endphp</b><br/>
	</div>
	<div class="col-sm-6" id="image-display">
		<!--If a button is pressed (next or previous), get the new image-->
		@if ($next_image = Session::get('next_image'))
			<img class="col-sm-12" name="display" style="max-height: 300px;" id='image' src="{{'../' . $next_image->image_location}}" alt="{{$next_image->source}}">
		@else
			<img class="col-sm-12" name="display" style="max-height: 300px;" id='image' src="{{'../' . $image->image_location}}" alt="{{$image->source}}">
		@endif
		
				@php 
					$all_images = DB::table('images')->where('ref_id', $animal->id)->where('ref_type', 'PET')->get('image_id');
					$num_of_images = count($all_images);
				@endphp
				@if($current_image = Session::get('current_image'))
				@else @php $current_image = 1; @endphp
				@endif
			<form class="col-sm-12" action="{{ route('display.control.post', [$animal->id, 'changeImage', $current_image]) }}" method="POST" enctype="multipart/form-data">
      	@csrf
      		<div class="col-sm-2">
      		@if($current_image>1)
					<button class="btn" name="back" id="back">Previous</button>
				@endif
				</div>
			
				<div class="col-sm-offset-3 col-sm-2">
					@if($current_num = Session::get('current_image'))
						{{$current_num}}
					@else
						1
					@endif
					/{{$num_of_images}}
				</div>
				
				<div class="col-sm-offset-3 col-sm-2">
				@if(Session::get('last_image')==0)
					<button class="btn" name="next" id="next">Next</button>
				@endif
				</div>
			</form>
			@if($option = Session::get('option'))
				{{$option}}
			@endif
			<div class="line-break col-sm-12"></div>
			<div class="col-sm-12">
				@if(Auth::check())
					@if(Auth::user()->type == 'STAFF')
					<form class="col-sm-12" action="{{ route('display.control.post', [$animal->id, 'addImage', Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
					@csrf						
						<p class="col-sm-4">Add Image</p>
						<input type="file" id="image_input" style="height: 30px;" name="new_image" class="col-sm-2 form-control" required>
						<div class="line-break col-sm-12"></div>
						<button name="add_image" class="btn col-sm-2 col-sm-offset-4">Add</button>
					</form>
						@if($message = Session::get('message'))
							{{$message}}
						@endif
					@endif
				@endif
			</div>

	</div>

	@if(Auth::check())
		@if(Auth::user()->type == 'USER') <!--Check if viewer is a user-->
			@php 
				$application = DB::table('adoption-_records')->where('ref_id', Auth::user()->id . $animal->id)->first();
			@endphp
			<div class="col-sm-10 col-sm-offset-3">
			@if(Session::get('application_sent') or $application)
				<b class="col-sm-offset-3">Application Sent</b>
			<!-- Else check the animal has not already been adopted by someone else before displaying the adoption-->
			@elseif (!$adopted)
				<form action="{{ route('display.control.post', [$animal->id, 'adopt', Auth::user()->id]) }}" method="POST" enctype="multipart/form-data" >
				@csrf
					<button class="btn col-sm-offset-4" type="submit" name="submit_application" >Apply To Adopt</button>			
				</form>
			@endif
			</div>
		
		@elseif(Auth::user()->type == 'STAFF') <!--Check if the viewer is staff-->
			<div class="col-sm-offset-2 col-sm-10">
			@if($animal->adopted == 0)
				@php $applications = DB::table('adoption-_records')->where('adoptee_id', $animal->id)->get() @endphp
				<b class="">Applications to adopt by: </b>
				@foreach($applications as $record)
					<br/><a href='{{ url('/adoption-record', $record->ref_id) }}' class="col-sm-offset-1">{{  $record->adopter  }}</a>
				@endforeach
			@else 
				<b>Adopted By: </b>{{DB::table('adoption-_records')->where('adoptee_id', $animal->id)->where('STATUS', 'ACCEPTED')->first()->adopter}};
			@endif
			
			</div>
		@endif
	@endif
	
@endsection
	
