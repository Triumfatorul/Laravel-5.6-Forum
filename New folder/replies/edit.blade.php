@extends('layouts.app')

@section('content')
	<div class="form margin">
		{!! Form::open(['action' => ['RepliesController@update', $reply->id], 'method' => 'POST']) !!}
			<div class="form-group">
    			{{Form::label('content', 'Content')}}
    			{{Form::textarea('content', $reply->body, [ 'class' => 'form-control', 'placeholder' => 'Content'])}}
    		</div>
            {{Form::hidden('_method', 'PUT')}} 
			{{Form::submit('submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
	</div>
@endsection