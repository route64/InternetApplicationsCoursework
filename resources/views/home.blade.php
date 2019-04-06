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
						  <table>
						  </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
