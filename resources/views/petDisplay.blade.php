@extends('layouts.app')

@section('content')
	<div class="col-sm-offset-2 col-sm-4">
		<h1 id="animal-name">{{$animal->name}}</h1>
		<p id="animal-dob"><b>DOB:</b> {{$animal->DOB}}</p><br/>
		<p id="animal-desc"><b>Description:</b> {{$animal->description}}</p><br/>
	</div>
	<div class="col-sm-6" id="image-display">
		<!--If a button is pressed (next or previous), get the new image-->
		@if ($next_image = Session::get('next_image'))
			<img class="col-sm-12" name="display" style="max-height: 300px;" id='image' src="{{'../' . $next_image->image_location}}" alt="{{$next_image->source}}">
		@else
			<img class="col-sm-12" name="display" style="max-height: 300px;" id='image' src="{{'../' . $image->image_location}}" alt="{{$image->source}}">
		@endif
		
			<form class="col-sm-12" action="{{ route('image.next.post', [$image->image_id]) }}" method="POST" enctype="multipart/form-data">
      	@csrf
				<button class="btn col-sm-2" name="back" id="back">Previous</button>
				
				@if(!Session::get('last_image'))
					<button class="btn col-sm-offset-8 col-sm-2" name="next" id="next">Next</button>
				@endif
			</form>
	</div>

	@if(Auth::check())
		@if(Auth::user()->type == 'USER') <!--Check if viewer is a user-->
			<form method="get">
			<button class="btn col-sm-offset-4" onclick='' value="submit" name="submit" type="submit" id="adopt-btn" >Apply To Adopt</button>
			</form>
			
			<?php  function submitApplication($animalID){
				$date = new DateTime();
				try{
					DB::table('adoption-_records')->insert(
					['created_at'=> $date,
					'ref_id'=>Auth::user()->id . $animalID ,
					'adopter'=>Auth::user()->username , 
					'adoptee_id'=>$animalID, 
					'status'=>'PENDING']);
					
					print '<script>alert("Application sent!")</script>'; 
				}
				catch(Exception $e){
					print '<script>alert("Application previously sent! Cannot send two applications for the same animal.")</script>';				
				}	
			 	
				
			}?>
			
		
		
			@if (isset($_GET['submit']))
				{{submitApplication($animal->id)	}}	
			@endif
		
		@elseif(Auth::user()->type == 'STAFF') <!--Check if the viewer is staff-->
			<div class="col-sm-12"><b class="col-sm-offset-2">Application to adopt by: </b></div>
		@endif
	@endif
	
@endsection
	
