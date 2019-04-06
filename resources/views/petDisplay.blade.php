@extends('layouts.app')

@section('content')
	<div class="col-sm-offset-2 col-sm-4">
		<h1 id="animal-name">{{$animal->name}}</h1>
		<p id="animal-dob"><b>DOB:</b> {{$animal->DOB}}</p><br/>
		<p id="animal-desc"><b>Description:</b> {{$animal->description}}</p><br/>
	</div>
	<div class="col-sm-4" id="image-display">
		<img class="col-sm-12" id='image' src="{{'../' . $images[0]->image_location}}" alt="{{$images[0]->source}}">
	
		<button class="btn col-sm-offset-2 col-sm-2" id='previous' onclick='previous()'>Previous</button>
		<button class="btn col-sm-offset-4 col-sm-2" id="next" onclick='nextImage()'>Next</button>
	</div>

	@if(Auth::check())
		
			<form method="get">
			<button class="btn col-sm-offset-4" onclick='' value="submit" name="submit" type="submit" id="adopt-btn" >Apply To Adopt</button>
			</form>
			
			<?php  function submitApplication($animalID){
				try{
					DB::table('adoption-_records')->insert(
					['ref_id'=>Auth::user()->id . $animalID ,
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
	@endif
	
@endsection
	
@section('scripts')
<script type="text/javascript">
	var images = [
   	@foreach($images as $key => $image)
      	{{'../'.$image->image_location}}
      @endforeach
   ];

	var imageIndex = 0;
			
	function previous() {
		imageIndex = (imageIndex + images.length -1) % (images.length);
		document.getElementById('image').src = images[imageIndex];
	}	
  
</script>
@endsection