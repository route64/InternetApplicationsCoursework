@extends('layouts.app')


@section('title', 'contact')

@section('content')
	<h1 id="animal-title">Animals Up For Adoption</h1>
	<div id="animal-display-options" class="col-sm-offset-2 col-sm-10">
		<form action="{{ route('animals.sort.post') }}" method="POST" enctype="multipart/form-data">
			@csrf
			@if($sortedAnimals = Session::get('animals'))
				<?php $animals = $sortedAnimals;?>
			@endif
			<b>Show</b> <select id="select_species" name="show_by_species">
				<option id="all" >All</option>
				<option id="birds ">Birds</option>
				<option id="cats" >Cats</option>
				<option id="dogs" >Dogs</option>
				<option id="guinea-pigs" >Guinea Pigs</option>
				<option id="hamsters" >Hamsters</option>
				<option id="rabbits" >Rabbits</option>
			</select>
			<b>Sort By</b> <select name="sort_by">
				<option id="sort">Choose Option</option>
				<option id="name_sort">Name</option>
				<option id="dob_sort_asc">DOB Ascending</option>
				<option id="dob_sort_desc">DOB Descending</option>
			</select>
			@if(Auth::check())
				@if(Auth::user()->type == 'STAFF')
					Show <select name="show_by_adopted">
						<option id="adopted-and-not" >All</option>
						<option id="adopted-sort" >Adopted</option>
						<option id="not-adopted-sort" >Not adopted</option>
					</select>
				@endif
			@endif
			<button type="submit" class="btn">Apply</button>
		</form>
	</div>
	<table class="col-sm-offset-2" id="animal-table">
		<thead>
			<tr>
				<th class="col-md-1">Name</th>
				<th class="col-md-1">DOB</th>
				<th class="col-md-1">Species</th>
				<th class="col-md-4">Description</th>
				<th class="col-md-4">Image</th>
				<th class="col-md-1">Adopted</th>			
			</tr>
		</thead>
		<tbody>
			@if(Session::get('animals'))
				<?php $animals = Session::get('animals'); ?>
			@endif
			@foreach($animals as $key => $animal)
				<tr>
					<td><a href="{{ url('animal-display', $animal->id) }}">{{$animal->name}}</a></td>
					<td>{{$animal->DOB}}</td>
					<td>{{$animal->species}}</td>
					<td><pre>{{$animal->description}}</pre></td>
					<td><img src={{$animal->primary_image_location}} alt="{{ $animal->primary_image_location }}" ></td>
					<td>@php if($animal->adopted == 0){ print "Not Adopted";} else {Print "I'm Adopted";} @endphp</td>
				</tr>
				
			@endforeach
		</tbody>
	</table>

	
@endsection