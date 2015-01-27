@extends('layouts.master')

@section('title') Upload a File @stop

@section('content')
	<div>
		<a href="{{$download}}" target="_blank" class="btn btn-primary btn-lg btn-block">Download</a>
	</div>

	<div class="preview">
		<img src="{{$download}}" />
	</div>
@stop