@extends('layouts.app')


@section('title', 'contact')

@section('content')
	<h1 id="animal-title">Animals Up For Adoption</h1>
	<div id="animal-display-options" class="col-sm-offset-2">
		<form action="{{ route('animals.sort.post', 'search_records') }}" method="POST" enctype="multipart/form-data">
		@csrf
			<b>Name</b><input name="search_names" id="search-animals"/>
			<button class="btn">Search</button>
		</form>
		<form action="{{ route('animals.sort.post', 'sort-animals') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<?php $chosen_species = 'all'; $sorted_by = 'none'; ?>
			@if($sortedAnimals = Session::get('animals'))
				<?php $animals = $sortedAnimals;
				$chosen_species = Session::get('chosen_species');
				$sorted_by = Session::get('sorted_by'); ?>
			@endif
			<b>Show</b> <select id="select_species" name="show_by_species">
				<option id="all" @if($chosen_species == 'all') selected="selected" @endif>All</option>
				<option id="birds" @if($chosen_species == 'Birds') selected="selected" @endif>Birds</option>
				<option id="cats" @if($chosen_species == 'Cats') selected="selected" @endif>Cats</option>
				<option id="dogs" @if($chosen_species == 'Dogs') selected="selected" @endif>Dogs</option>
				<option id="guinea-pigs" @if($chosen_species == 'Guinea Pigs') selected="selected" @endif>Guinea Pigs</option>
				<option id="hamsters" @if($chosen_species == 'Hamsters') selected="selected" @endif>Hamsters</option>
				<option id="rabbits" @if($chosen_species == 'Rabbits') selected="selected" @endif>Rabbits</option>
			</select>
			<b>Sort By</b> <select name="sort_by">
				<option @if($sorted_by == 'none') selected="selected" @endif>Choose Option</option>
				<option @if($sorted_by == 'Name') selected="selected" @endif>Name</option>
				<option @if($sorted_by == 'DOB Ascending') selected="selected" @endif>DOB Ascending</option>
				<option @if($sorted_by == 'DOB Descending') selected="selected" @endif>DOB Descending</option>
			</select>
			<button type="submit" class="btn">Apply</button>
		</form>
	</div>
	@if($searched_for = Session::get('searched_for'))
		<div class="col-sm-offset-2">Showing Results for: {{$searched_for}}</div>
	@endif
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
				<?php 
					$animals = Session::get('animals');
				?>
			@endif
			@foreach($animals as $key => $animal)
			<?php
				$date = $animal->DOB;
						$year = date('Y', strtotime($date));
						$month = date('F', strtotime($date));
						$day = date('j', strtotime($date));
						
						if($animal->adopted == 0){ 
							$adoption_status = "Not Adopted";
						} else {$adoption_status =  "I'm Adopted";}
						
						$rowData = '<tr><td><a href="'. url('animal-display', $animal->id).'">'.$animal->name.'</a></td>
						<td>'.$day . ' ' . $month. ' '. $year .'</td>
						<td>'.$animal->species.'</td>
						<td><pre>'.$animal->description.'</pre></td>
						<td><img src='.$animal->primary_image_location.' alt="'. $animal->primary_image_location .'" ></td>
						<td>'.$adoption_status.'</td>
						</tr>';
			?>
			<!-- Guests and users can view only the animals available for adoption-->
			@if(!$animal->adopted)
				@php echo $rowData; @endphp
			<!--Staff can view all the animals-->
			@elseif(Auth::check())
				@if(Auth::user()->type=='STAFF')
					@php echo $rowData; @endphp
				@endif
			@endif
			@endforeach
		</tbody>
	</table>	
@endsection