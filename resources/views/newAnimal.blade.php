@extends('layouts.app')

@section('stylesheets')
<link href="{{ asset('../resources/css/general-style.css') }}" rel="stylesheet">
@endsection

@section('content')
@if(Auth::check())	 
	 <!--Check user is staff and if not display error message-->
	 @if(Auth::user()->type == 'STAFF')
	 
	 	<h1 id="new-animal-title" style="text-align: center;">Add New Record</h1>
		<div class="col-sm-offset-2">
	 	
		<div class="panel-body">
        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>

        <img src="images/{{ Session::get('image') }}">

        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

  

        <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            	<div class="row col-sm-12">
            		<b class="col-sm-2">Name:</b> <input type="text" name="petName" class="col-sm-4 form-control" required>
            	</div>
            	<div class="row col-sm-12">
            		<b class="col-sm-2">DOB: </b><input type="date" name="dob" class="col-sm-3 form-control" required>
            	</div>
            	<div class="row col-sm-12">
            		<b class="col-sm-2">Gender: </b><select name="gender"><option>FEMALE</option><option>MALE</option></select>
            	</div>
            	<div class="row col-sm-12">
            		<b class="col-sm-2">Species: </b><select name="species"><option>CAT</option>
            			<option>DOG</option>
            			<option>BIRD</option>
            			<option>RABBIT</option>
            			<option>HAMSTER</option>
            			<option>LIZARD</option>
            		</select>
            	</div>
            	<div class="row col-sm-12">
            		<b class="col-sm-2">Description: </b><textarea type="text" style="font-size: 100%;" maxlength="500" name="desc" id="new-animal-desc" class="col-sm-6 form-control" required></textarea>
            	</div>
                <div class="row col-sm-12" style="height: 40px;">
                    <b class="col-sm-2">Primary Image: </b><input type="file" id="primary-image-input" style="height: 30px;" name="image" class="col-sm-2 form-control" required>               
                </div>
					 <div class="row col-sm-12" style="height: 40px;">
                   <a href="#" class="col-sm-3 btn" style="font-size: 90%;" id="more"
                   onclick="$('#extra-images').slideToggle(function(){
                   	$('#more').html($('#extra-images').is(':visible')?'Add Fewer Images':'Add More Images');});">
                   	Add More Images
                   </a>                
                   <div id='extra-images' style="display: none;">
                    <input type="file" id="extra-image-input-2" style="height: 30px;" name="image2" class="col-sm-4 form-control">               
                    <input type="file" id="extra-image-input-3" style="height: 30px;" name="image3" class="col-sm-4 form-control">
                    <input type="file" id="extra-image-input-4" style="height: 30px;" name="image4" class="col-sm-4 form-control">              
                	</div>
                </div>
                
                <div class="row col-sm-12">
                    <button type="submit" id="upload-new-record" class="btn btn-success col-sm-offset-3">Upload</button>
                </div>
        </form>
      </div>
	 </div>
@endif
@else
	 <!-- Not staff so should not be viewing this page-->
	 <div id="access-denied"><img style="border: solid 3px blue;" src="../resources/images/messages/accessDenied.png" alt="Access Denied"></div>
	 @endif
@endsection