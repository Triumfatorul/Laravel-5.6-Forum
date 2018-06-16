@extends('layouts.app')

@section('content')
		<h1>Edit post</h1>
		{!! Form::open(['action' => ['PostController@update', $posts->id], 'method' => 'POST']) !!}
    		<div class="form-group">
    			{{Form::label('title', 'Title')}}
    			{{Form::text('title', $posts->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
    		</div> 
			<div class="form-group">
    			{{Form::label('content', 'Content')}}
    			{{Form::textarea('content', $posts->body, [ 'class' => 'form-control', 'placeholder' => 'Content'])}}
    		</div>
            {{Form::hidden('_method', 'PUT')}} 
			{{Form::submit('submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
@endsection