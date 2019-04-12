@extends('layouts.app')

@section('stylesheets')
<link href="{{ asset('../resources/css/general-style.css') }}" rel="stylesheet">
@endsection

@section('content')
	 <!--Check user is staff and if not redirect-->
	 @if(Auth::user()->type == 'STAFF')
	 <?php  function approveApplication($ref_id){
				$date = new DateTime();
				try{
					DB::table('adoption-_records')->where('ref_id', $ref_id)->update(
					['updated_at'=> $date,
					'status'=>'APPROVED']);
					
					print '<script>alert("Application Approved!")</script>'; 
				}
				catch(Exception $e){
					print '<script>alert("Error! check application not already approved")</script>';				
				}	
			 	
				
			}?>
	 	<table class="col-sm-offset-1 col-sm-10" id="adoption-records-table-staff-view">
	 		<thead>
				<th class="col-sm-2">Reference ID</th>
				<th class="col-sm-2">Animal Name</th>
				<th class="col-sm-3">Status</th>
				<th class="col-sm-3">Submitted At</th>	
				<th class="col-sm-2">Approve</th>	
	 		</thead>
	 		<tbody>
	 			@foreach($adoptionRecordsdb as $key => $record)
	 			<tr>
	 				<td>{{ $record->ref_id }}</td>
	 				<td><?php $animal = $animaldb->where('id', '=', $record->adoptee_id) ?>
						@foreach($animal as $an)
							{{$an->name}}
						@endforeach
					</td>
	 				<td>{{ $record->status }}</td>
	 				<td>{{ $record->created_at }}</td>
	 				<td><a href='{{ url('/adoption-record', $record->ref_id) }}' ><button class="btn">View Details</button></a>
	 				</td>
	 			</tr>
				@endforeach
	 		</tbody>
	 	</table>
	 	
	 @else
	 	<div id="access-denied">Access Denied</div> 
	 @endif
@endsection