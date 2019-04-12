@extends('layouts.app')


@section('title', 'contact')

@section('content')
	<h1 id="animal-title">Animals Up For Adoption</h1>
	<table class="col-sm-offset-2" id="animal-table">
		<thead>
			<tr>
				<th class="col-sm-1">Name</th>
				<th class="col-sm-1">DOB</th>
				<th class="col-sm-1">Species</th>
				<th class="col-sm-4">Description</th>
				<th class="col-sm-4">Image</th>
				<th class="col-sm-1">Adopted</th>			
			</tr>
		</thead>
		<tbody>
			@foreach($animals as $key => $animal)
				<tr id='test' >
					<td><a href="{{ url('animal-display', $animal->id) }}">{{$animal->name}}</a></td>
					<td>{{$animal->DOB}}</td>
					<td>{{$animal->species}}</td>
					<td>{{$animal->description}}</td>
					<td><img src={{$animal->primary_image_location}} alt="{{ $animal->primary_image_location }}" ></td>
					<td>@php if($animal->adopted == 0){ print "Not Adopted";} else {Print "I'm Adopted";} @endphp</td>
				</tr>
				
			@endforeach
		</tbody>
	</table>

	
@endsection