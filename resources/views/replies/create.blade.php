@extends('layouts.app')

@section('content')
		<h1>Create post</h1>
		{!! Form::open(['action' => 'RepliesController@store', 'method' => 'POST']) !!}
			<div class="form-group">
    			{{Form::label('content', 'Content')}}
    			{{Form::textarea('content', '', [ 'class' => 'form-control', 'placeholder' => 'Content'])}}
                {{Form::hidden('post_id', $post_id)}}
     		</div>
			{{Form::submit('submit', ['class' => 'btn btn-primary'])}}
		    {!! Form::close() !!}
@endsection
