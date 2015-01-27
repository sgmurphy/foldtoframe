@extends('layouts.master')

@section('title') Upload a File @stop

@section('content')
	<div class="page-header">
		<h1>
			Upload a File
		</h1>
	</div>

	{{ Form::open(['route' => 'photo.store', 'files' => true, 'role' => 'form']) }}
		<div class="form-group">
			{{ Form::file('file') }}
		</div>
		{{ Form::submit('Upload', ['class' => 'btn btn-primary']) }}
	{{ Form::close() }}
@stop