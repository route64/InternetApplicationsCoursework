@extends('layouts.app')

@section('stylesheets')
<link href="{{ asset('../resources/css/general-style.css') }}" rel="stylesheet">
@endsection
@section('content')
@if(Auth::check())
	<h1 id="adoption-record-title">Adoption Record</h1>
	<div id="animal-information" class="col-md-offset-1 col-md-5">
		<?php $animal_id= $adoptionRecord->adoptee_id;
		$animal = $animals->where('id', $animal_id)->first(); ?>
		<h2>Adoptee</h2>		
		<p><b>Name: </b>{{$animal->name}}</p>
		<p><b>DOB:</b> {{$animal->DOB}}</p><br/>
		<p><b>Gender:</b> {{$animal->gender}}</p><br/>
		<p><b>Species:</b> {{$animal->species}}</p><br/>
		<p><b>Description:</b> {{$animal->description}}</p><br/>
	</div>
	<div id="adopter-information" class="col-md-offset-1 col-md-5">
		<?php $username = $adoptionRecord->adopter;
		$user = $users->where('username', $username)->first(); ?>
		<h2>Application To Adopt By</h2>
		<p><b>Username:</b> {{$username}}</p>
		<p><b>Name:</b> {{$user->title ." ". $user->name}}</p>
		<p><b>Address:</b> {{$user->address . ' '. $user->post_code}}</p>
		<p><b>Phone Number:</b> {{$user->phone_no}}</p>
		<p><b>Email:</b> {{$user->email}}</p>
	</div>
	<!--Display buttons for approving or denying an adoption application -->
	@if($adoptionRecord->status=='PENDING')
	<form method="get" class="col-sm-12">
		<button name="approve-application" id="approve-application-btn" class="col-md-offset-3 btn">Approve Application</button>
		<button name="deny-application" id="deny-application-btn" class="col-md-offset-1 btn">Deny Application</button>
	</form>
	@else
		<b class="col-sm-12" id="application-status" @if($adoptionRecord->status=='ACCEPTED') style="background:green;" @else style="background:red;" @endif>APPLICATION {{$adoptionRecord->status}}</b>
	@endif
	<?php 
		function approveApplication($ref_id, $animal_id){
			
				DB::table('adoption-_records')->where('ref_id', $ref_id)->update([
					'updated_at'=>new DateTime(),
					'status' => 'ACCEPTED'			
				]);
				DB::table('animals')->where('id', $animal_id)->update([
					'updated_at'=>new DateTime(),
					'adopted' => '1'			
				]);
				print '<script>alert("Application approved!")</script>'; 
			header("Refresh:0; url='../adoption-record/$ref_id'");
		}
		function denyApplication($ref_id){
			try{
				DB::table('adoption-_records')->where('ref_id', $ref_id)->update([
					'updated_at'=>new DateTime(),
					'status' => 'DENIED'			
				]);
				print '<script>alert("Application denied!")</script>'; 
				header("Refresh:0; url='../adoption-record/$ref_id'");
			}
			catch(Exception $e){
				print '<script>alert("Error! Can\'t deny application")</script>';				
			}	
		}
	?>
	@if (isset($_GET['approve-application']))
		{{approveApplication($adoptionRecord->ref_id, $adoptionRecord->adoptee_id)}}
	@endif
	@if (isset($_GET['deny-application']))
		{{denyApplication($adoptionRecord->ref_id)}}
	@endif
@else
<!-- Not logged in-->
<div id="access-denied">Logged Out Due To Inactivity</div>
@endif
@endsection