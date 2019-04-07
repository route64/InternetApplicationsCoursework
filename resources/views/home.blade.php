@extends('layouts.app')

@section('stylesheets')
<link href="{{ asset('../resources/css/general-style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div style="text-align: center;" id="welcome-user">Welcome {{ Auth::user()->username }}!</div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <!--div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div-->
                    @endif
                    <h2 style="text-align: center;">Adoption Applications</h2>
						<?php $records = $adoptionRecordsdb->where('adopter', '=', Auth::user()->username)->get() ?>
						@if ($records != '[]')						  
						  	<table id="userApplicationsTable">
						  		<thead>
									<th class="col-sm-2">Reference ID</th>
									<th class="col-sm-4">Animal Name</th>
									<th class="col-sm-3">Status</th>
									<th class="col-sm-3">Submitted At</th>						  		
						  		</thead>
						  		<tbody>
										@foreach($records as $record)
										<tr>
											<?php $animalrecord = $animaldb->where('id', '=', $record->adoptee_id)->get() ?>
											<td>{{ $record->ref_id }}</td>
											<td> @foreach($animalrecord as $ar) {{ $ar->name  }}@endforeach</td>
											<td>{{ $record->status }}</td>
											<td>{{ $record->created_at }}</td>
										</tr>
										@endforeach						  		
						  		</tbody>
						  	</table>
						@else
							<h3 style="text-align: center;">No Applications</h3>
						@endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
