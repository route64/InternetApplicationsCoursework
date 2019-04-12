<!--Information about te staff wit te option to edit information about yourself if you are staff-->
@extends('layouts.app') 
@section('title', 'contact')

@section('content')
@if(Auth::check())
@else
@endif
@endsection