@extends('layouts.app')

@section('content')
		<h1>Edit post</h1>
		{!! Form::open(['action' => ['RepliesController@update', $reply->id], 'method' => 'POST']) !!}
			<div class="form-group">
    			{{Form::label('content', 'Content')}}
    			{{Form::textarea('content', $reply->body, [ 'class' => 'form-control', 'placeholder' => 'Content'])}}
    		</div>
            {{Form::hidden('_method', 'PUT')}} 
			{{Form::submit('submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
@endsection